<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
require "../application/cart.php";
session_start();
print_r($_POST);
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
</head>

<body>

<h2>Checkout</h2>

<p>
<?php
$cart = $_SESSION['cart'];
$order = $cart->order;
$valCount = count($order);
$totalOrder = 0;

if ($valCount == 0) {
  echo "<br /><br />
  <strong>
  <h4 id='emptyCart'>Your cart is empty.
  There is nothing to purchase</h4></strong>";
}

else {
  // initialize the table and add headers.
  echo "Here is your order:";
  echo "<table>";
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

// Poor man's display of shopping cart
// $_SESSION['cart']->display();
session_unset();  // remove all session variables
session_destroy();
?></p>

<!-- Create HTML Form -->

<form id = "form" method="post">
  <strong>Shipping Info</strong><br />
  <p>
  Name: <input type="text" name="name" value="<?php echo $name;?>"></span><br><br>
  Street address: <input type="text" name="streetaddress"
                value="<?php echo $name;?>"></span><br><br>
  City: <input type="text" name="city" value="<?php echo $name;?>"></span><br><br>
  State: <input type="text" name="state" value="<?php echo $name;?>"></span><br><br>
  Zipcode: <input type="number" min='11111' max="99999" name="zipcode" value="<?php echo $name;?>"></span><br><br>
  Email: <input type="email" name="email" value="<?php echo $name;?>"></span><br><br>
  Phone: <input type="tel" name="name" value="<?php echo $name;?>"></span><br><br>
</p>
<p>
  <strong>Girl Scout Info</strong><br />
  Scout name: <input type="text" name="scoutname"/>
  Troop name: <input type="text" name="troopname" />
</p>

<button type="submit" value="submitOrder">Submit Order</button>
</form>

<?php
  if(isset($_POST["submitOrder"])) {
    echo 3;
  }
?>
<p id="paid">Your credit card will be billed.  Thanks for the order!</p>

<?php
  if ($valCount == 0) {
    echo "<script type='text/javascript'>
          document.getElementById('paid').style.display = 'none';
          </script>";
    echo "<script type='text/javascript'>
          document.getElementById('form').style.display = 'none';
          </script>";

  }
?>

<p><a href="index4.php">Shop some more!</a></p>

</body>
</html>
