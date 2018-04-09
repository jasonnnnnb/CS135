<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
  require "../application/cart.php";
  require "states.php";
  require '../Backend/dbconn.php';

  $connection = connect_to_db("GSC");

  session_start();
  print_r($_POST);
  print_r($_SESSION);
?>

<!DOCTYPE html>
<?php
// If this session is just beginning, store an empty ShoppingCart in it.
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = new ShoppingCart();
  }
?>

<html lang="en">

<head>
  <title>Checkout</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
  </script>
  <script src="validation.js"></script>

</head>

<body>

<h2>Checkout</h2>

<p>
  <?php
  $cart = $_SESSION['cart'];
  $order = $cart->order;
  $valCount = count($order);
  $totalOrder = 0;

  if (!$valCount == 0) {
    // initialize the table and add headers.
    echo "<table id = 'ordersum'>";
    echo "<caption> Here is your order:</caption>";
    echo "<tr>
            <th>Cookie</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>";

    foreach (ShoppingCart::$cookieTypes as $cookie => $displayName) {
      // Iterate over rows
      if (array_key_exists($cookie, $order)) {
        echo "<tr>";
        // Add name
          echo "<td>";
          echo $displayName;
          echo "</td>";
          // Add quantity
          echo "<td>";
          echo $order[$cookie];
          echo "</td>";
          // Add Total Price
          echo "<td>";
          echo "$" . $order[$cookie] * 5;
          echo "</td>";
        echo "</tr>";

        // Update $totalOrder
        $totalOrder += $order[$cookie];
        }
        echo "</tr>";
      } //end loop

      // Total
      echo "<tr>";
        echo "<td><strong>Total</strong></td>";
      // Total Quantity
      echo "<td>$totalOrder</td>";
      // Total price
      echo "<td>"."$".($totalOrder * 5)."</td>";

      echo "</tr>";
      echo "</table>";
    }
?></p>
<!-- Create HTML Form -->
<form id ="form" method="post" name='orderdata'>
  <strong>Shipping Info</strong><br />
    <p style="line-height:25px;">

    <legend for="firstname">First name:
    <input type="text" id = "firstname" name="firstname"> </legend>

    <legend for="lastname">Last name:
    <input type="text" id = "lastname" name="lastname" value=""> </legend>

    <legend for="street">Street Address:
    <input type="text" id = "street" name="street" value=""> </legend>

    <legend for="city">City:
    <input type="text" id = "city" name="city" value=""> </legend>

    <legend for="state">State:
    <input type="text" id = "state" name="state" value=""
    onkeyup="showHint(this.value)"></legend>
    Suggestions: <span id="txtHint"></span>

    <legend for="zipcode">Zipcode:
    <input type="number" id = "zipcode" name="zipcode" value=""
            min='11111' max='99999'> </legend>

    <legend for="phone">Phone number:
    <input type="tel" id = "phone" name="phone" value=""> </legend>

    <legend for="email">Email:
    <input type="email" name="email" id = "email" value=""> </legend>

    <br />
    <strong>Girl Scout Info</strong><br />
    <legend for="scout">Scout Name:
    <input type="text" name="scoutname" id = "scoutname" value=""> </legend>

    <legend for="troop">Scout Troop:
    <input type="text" name="troop" id = "troop" value=""> </legend>
    </p>
    <button id ="subbutton" onclick="return revalidate()">Place Order</button>
</form>

<script type='text/javascript'>
  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('txtHint').innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "states.php?q="+str, true);
      xmlhttp.send();
    }
  }
  // Activate submit button
</script>

<!-- Server side validation -->
<?php

// echo "working";
  $works = true;
  $items = ["firstname", "lastname", "street", "city", "state", "zipcode",
            "troop", "scoutname", "email", "phone"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($items as $key) {
      if (!isset($_POST[$key])) {
        $works = false;
      }
        else {
          verifylen($key, 0);
        }
    } //end of loop

// Validation methods
  verifylen('scoutname', 3);
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "1";
    $works = false;
  }
  if(!preg_match("/^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$/", $_POST['phone'])) {
    echo "2.5";
    $works = false;
  }
  if(!preg_match("/^\d{5}(?:[-\s]\d{4})?$/", $_POST['zipcode'])) {
    echo "3.5";
    $works = false;
  }
  if(!preg_match("/^\d+\s[A-z]+\s[A-z]+$/", $_POST['street'])) {
    echo "4.5";
    $works = false;
  }
  if ($works) {
    require "toDb.php";
    session_unset();
    session_destroy();

    echo "<script type='text/javascript'>
    $('#form').hide();
    $('#ordersum').hide();
    </script>";

    echo "<p><big><big>
    Thanks for shopping!
    </big></big></p>";
  }
}
  function verifylen($field, $len) {
    if (strlen($_POST[$field]) <= $len) {
      echo "<script type='text/javascript'>
      alert('Make sure ' + $field.name + ' has more than '
      + $len + ' characters.')
      </script>";
      $works = false;
    }
  }

?>



<p><a href="index4.php">Shop some more!</a></p>


</body>
</html>
