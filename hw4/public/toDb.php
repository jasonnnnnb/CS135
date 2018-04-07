<?php

require "queries.php";
// Set database variables
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$street = $_POST['street'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$troop = $_POST['troop'];
$gsname = $_POST['scoutname'];
$email = $_POST['email'];

//////////
//Add info to database
//////////

// Customer information:
  mysqli_stmt_execute($selectCustomer);
  $selectCustomer -> bind_result($customer_id);
  // Existing customer in database
  if ($selectCustomer -> fetch() ) {
    echo "Thanks for shopping again customer $customer_id! <br />";
  }
  else {
    // Add customer to database
    mysqli_stmt_execute($insertCustomer);
    $customer_id = mysqli_stmt_insert_id($insertCustomer);
    echo "Thanks for being a new customer! You are customer #$customer_id. <br />";
  }
  // end statements
  mysqli_stmt_close($selectCustomer);
  mysqli_stmt_close($insertCustomer);

// Order information
  mysqli_stmt_execute($insertOrder);
  $order_id = mysqli_stmt_insert_id($insertOrder);
  echo "For reference, this is order # $order_id. <br />";
  mysqli_stmt_close($insertOrder);

  mysqli_stmt_execute($selectGirlscout);
    $selectGirlscout->bind_result($gs_id);
    if(!$selectGirlscout->fetch()){
      //Add new girl scout to db
      mysqli_stmt_execute($insertGirlscout);
      $gs_id = mysqli_stmt_insert_id($insertGirlscout);
    }
    mysqli_stmt_close($insertGirlscout);
    mysqli_stmt_close($selectGirlscout);

    // Loop through cookies to add to db

    foreach($_SESSION["cart"]-> order as $variety => $quantity){
      mysqli_stmt_execute($insertCookie);
}
      mysqli_stmt_close($insertCookie);



 ?>
