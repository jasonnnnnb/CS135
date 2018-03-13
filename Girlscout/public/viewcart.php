<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
require "../application/cart.php";
session_start();
print_r($_SESSION);
echo "<br>after starting a session in viewcart...";

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
<title>Girl Scout Cookie Shopping Cart</title>
</head>

<body>

<h2>Girl Scout Cookie Shopping Cart</h2>

<!-- <table >
  <tr>
    <th>Image</th>
    <th>Cookie</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Total Price</th>
    <th>Edit</th>
  </tr>
</table> -->

<p><?php


function makeCart() {
$cart = $_SESSION['cart'];
$order = $cart->order;
$valCount = count($order);

if ($valCount == 0) {
  echo "<strong>Your cart is empty.
  Please buy some cookies!</strong>";
}

else {
  // initialize the table and add headers.
  echo "<table>";
  echo "<tr>
          <th>Image</th>
          <th>Cookie</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total Price</th>
          <th>Edit</th>
        </tr>";

  foreach (ShoppingCart::$cookieTypes as $key => $displayName) {
    // Iterate over rows
    if (array_key_exists($key, $order)) {
      echo "<tr>";

      // create array with cookie info
      $cookieInfo = Array (1,2,3,4,5,6);
      for ($count = 0; $count < 6; $count++) {
          echo "<td>";
          echo $cookieInfo[$count];
          echo "</td>";
      }
      echo "</tr>";



      // echo $displayName .": ";
      // echo $order[$key] . " ";
      echo "<br />";
      }
    }
    echo "</table>";
  }


// $rows = 10; // amout of tr
// $cols = 10;// amjount of td
// echo "<table border='1'>";
//
// for($tr=1;$tr<=$rows;$tr++){
//
//     echo "<tr>";
//         for($td=1;$td<=$cols;$td++){
//                echo "<td align='center'>".$tr*$td."</td>";
//         }
//     echo "</tr>";
// }
// echo "</table>";


}


makeCart();


?></p>

<p><a href="index4.php">Resume shopping</a></p>

<p><a href="checkout.php">Check out</a></p>

</body>
</html>
