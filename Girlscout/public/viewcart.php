<?php
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
require "../application/cart.php";
session_start();
print_r($_SESSION);
echo "<br>after starting a session in viewcart...";
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
<title>Girl Scout Cookie Shopping Cart</title>
</head>

<body>

<h2>Girl Scout Cookie Shopping Cart</h2>

<table id="cartTable">
  <tr>
    <th>Image</th>
    <th>Cookie</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Total Price</th>
    <th>Edit</th>
  </tr>
</table>

<p><?php

if (isset($_SESSION['cart'])) {
    $c = count($_SESSION['cart']);
    for ($x=0; $x <= $c; $x++){
        echo '<tr><td>'.$_SESSION['cart']['itemID'].'</td>';
        echo '<td>'.$_SESSION['cart']['itemID']['quantity'].'</td>';
        $x++;
    }
}



    // foreach($_SESSION['cart'] as $item) {
    //     // Define cart variables
    //       $item_price = $item['product_price'];
    //       $item_quantity = $item['product_quantity'];
    //       $item_total_cost = $item_price * $item_quantity;
    //       $checkout_cart_subtotal += $item_total_cost;
    //   }


// Poor man's display of shopping cart
$_SESSION['cart']->display();
?></p>

<p><a href="index4.php">Resume shopping</a></p>

<p><a href="checkout.php">Check out</a></p>

</body>
</html>
