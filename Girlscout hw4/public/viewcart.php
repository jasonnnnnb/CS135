<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
require "../application/cart.php";
session_start();
print_r($_SESSION);
echo "<br>";
print_r($_POST);
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

<p><?php

function makeCart() {
$cart = $_SESSION['cart'];
$order = $cart->order;
$valCount = count($order);
$totalOrder = 0;
$variety = trim($_POST["variety"]);
$quantity = trim($_POST["quantity"]);


if ($valCount == 0) {
  echo "<strong>Your cart is empty.
  Please buy some cookies!</strong>";
}

else {
  // initialize the table and add headers.
  echo "<table>";
  echo "<tr>
          <th></th>
          <th>Cookie</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Edit</th>
        </tr>";

  foreach (ShoppingCart::$cookieTypes as $cookie => $displayName) {
    // Iterate over rows
    if (array_key_exists($cookie, $order)) {
      echo "<tr>";
        // Add image
        echo "<td>";
        $imgSrc = "cookies/" . $cookie . ".jpg";
        echo "<img src = $imgSrc />";
        echo "</td>";
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
        // Add Edit and Delete
        echo "<td>";
        echo "<form method='post'>";
          // input new amount
          echo "<input type='number' min='0' max='99999' name='$cookie'/>";
          // delete
          echo "<button type='submit' name = '$cookie' value='Delete'>
                Delete</button>";
        // echo "</form>";
        echo "</td>";
      echo "</tr>";

      // Update $totalOrder
      $totalOrder += $order[$cookie];
      }
      echo "</tr>";
    }
    // Total
    echo "<tr>";
      echo "<td></td>";
      echo "<td><strong>Total</strong></td>";
    // Total Quantity
    echo "<td>$totalOrder</td>";
    // Total price
    echo "<td>"."$".($totalOrder * 5)."</td>";
    // update
    // echo "<form method='post'>";
    echo "<td><button type='submit'>Update</button></td>";
    echo "</form>";

    echo "</tr>";
    echo "</table>";
  }
  // Delete
  foreach (ShoppingCart::$cookieTypes as $cookie => $displayName) {
    if (isset($_POST[$cookie]) && $_POST[$cookie]=="Delete") {
      unset($_SESSION['cart']->order[$cookie]);
      header("Refresh:0");
  }}
  // Edit
  foreach (ShoppingCart::$cookieTypes as $cookie => $displayName) {
    if (isset($_POST[$cookie]) && is_numeric($_POST[$cookie])) {
      echo $_SESSION['cart']->order[$cookie] = $_POST[$cookie];
      header("Refresh:0");

  }}

} //end makeCart()

makeCart();

?></p>

<p><a href="index4.php">Resume shopping</a></p>

<p><a href="checkout.php">Check out</a></p>

</body>
</html>
<!-- https://www.w3schools.com/php/php_form_complete.asp -->
