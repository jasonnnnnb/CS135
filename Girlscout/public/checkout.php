<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
require "../application/cart.php";
session_start();
print_r($_POST);
?>

<!DOCTYPE html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

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
  echo "<strong>
  <h4 id='emptyCart'>Your cart is empty.
  There is nothing to purchase.</h4></strong>";
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
?></p>

<!-- Create HTML Form -->

<form id="form" method="post" onsubmit="revalidate()">
  <strong>Shipping Info</strong><br />
  <p style="line-height:25px;">

    <legend for="firstname">First name:
    <input type="text" id = "firstname" name="firstname" value=""> </legend>

    <legend for="lastname">Last name:
    <input type="text" id = "lastname" name="lastname" value=""> </legend>

    <legend for="street">Street Address:
    <input type="text" id = "street" name="street" value=""> </legend>

    <legend for="city">City:
    <input type="text" id = "city" name="city" value=""> </legend>

    <legend for="state">State:
    <input type="text" id = "state" name="state" value=""> </legend>

    <legend for="zipcode">Zipcode:
    <input type="number" id = "zipcode" name="zipcode" value=""
            min='11111' max='99999'> </legend>

    <legend for="phone">Phone number:
    <input type="tel" id = "phone" name="phone" value="111-111-1111"> </legend>

    <legend for="email">Email:
    <input type="email" name="email" id = "email" value=""> </legend>

</p>
<p>
  <strong>Girl Scout Info</strong><br />
  <legend for="scout">Scout Name:
  <input type="text" name="scoutname" id = "scoutname" value=""> </legend>

  <legend for="troop">Scout Troop:
  <input type="text" name="troop" id = "troop" value=""> </legend>

</p>

<button type="submit" value="submitOrder">Submit Order</button>
</form>

<?php
  if(isset($_POST["submitOrder"])) {
    echo 3;
  }
?>
<p hidden id="paid">Your credit card will be billed.  Thanks for the order!</p>

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

<!-- JS validation. client side  -->

<script type='text/javascript'>

var validateField = function(fieldElem, infoMessage, validateFn) {
  // Add the span if there already isnt one
  if ($(fieldElem).next().length === 0) {
    $(fieldElem).after("<span>" + infoMessage + "<span>");
  }

  // Default hidden
  $(fieldElem).siblings().hide();

  // Change class to info while editing
  $(fieldElem).on("keyup", (function() {
    console.log("editing");
    $(fieldElem).siblings().text(infoMessage);
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("info");

  }))
  // If element doesnt validate
  if (validateFn == false) {
    console.log("Does not validate");
    $(fieldElem).siblings().text("Error");
    $(fieldElem).siblings().show();
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("error");
  }
  // If element doesnt is empty
  if ($(fieldElem).val().length === 0 ) {
   $(fieldElem).siblings().hide();
   $(fieldElem).siblings().removeClass();
 }
 // If element does validate
  if (validateFn == true) {
    console.log("Does validate");
    $(fieldElem).siblings().text("Okay");
    $(fieldElem).siblings().show();
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("ok");
}
};

$(document).ready(function() {
  // Validate every field
  $("#firstname").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#firstname").val()))
  }));
  $("#lastname").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#lastname").val()))
  }));
  $("#city").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#city").val()))
  }));
  $("#state").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#state").val()))
  }));
  $("#phone").on("blur", (function() {validateField($(this), "Number must be in XXX-XXX-XXXX format",
    validateNumber($("#phone").val()))
  }));
  $("#email").on("blur", (function() {validateField($(this), "Use standard email format",
    validateEmail($("#email").val()))
  }));
  $("#street").on("blur", (function() {validateField($(this), "Use standard address form",
    validateAddr($("#street").val()))
  }));
  $("#scoutname").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#scoutname").val()))
  }));
  $("#troop").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#troop").val()))
  }));
  $("#zipcode").on("blur", (function() {validateField($(this), "Enter a correct zip",
    validateZip($("#zipcode").val()))
  }));


});
// Validation functions for element e:

// Name must be alphabetic
function validateName(e) {
  var re = /^[a-zA-Z]+$/;
  return re.test(e);
}
// Phone number must be in form xxx-xxx-xxxx or xxxxxxxxxx
function validateNumber(e) {
  var re = /^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$/;
  return re.test(e);
}
// Password must be alphanumeric with at least 1 number
 function validatePassword(e) {
  var re = /(?=.*[0-9])[a-zA-Z]/;
  return re.test(e);
}
// Email must be in form xxx@xxxxx.xxx
var validateEmail = function (e) {
  var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return re.test(e);
}
var validateAddr = function (e) {
  var re = /^\d+\s[A-z]+\s[A-z]+$/
  return re.test(e);
}
var validateZip = function (e) {
  var re = /^\d{5}(?:[-\s]\d{4})?$/
  return re.test(e);
}

// Call on submit. Validates checkbox and radio selection, and
// makes sure all other fields are of class ok
function revalidate() {
    if ($(".ok").size() != 10) {
      alert("Please fill in every box and fix mistakes.");
    }
    else {
      // alert ("Submitted!");
      <?php echo session_unset(); ?>  // remove all session variables
      <?php echo session_destroy(); ?>  // remove all session variables
      // $("#paid").show();
      // $("#form").hide();
      <?php echo 45; ?>
    }
}

</script>

<p><a href="index4.php">Shop some more!</a></p>

</body>
</html>
