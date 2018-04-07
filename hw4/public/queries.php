<?php
// PDOStatements
// Insert into cookie
$query = "INSERT INTO cookies (order_id, variety, quantity, price)
          VALUES (?, ?, ?, ?)";
$insertCookie = $connection->prepare($query);
$insertCookie-> bind_param("isii", $order_id, $variety, $quantity, $price);

// Insert into order
$query = "INSERT INTO orders (customer_id, gs_id)
          VALUES (?, ?)";
$insertOrder = $connection-> prepare($query);
$insertOrder-> bind_param("ii", $customer_id, $gs_id);

// Insert into girlscout
$query = "INSERT INTO girlscout (gsname, troop)
          VALUES(?, ?)";
$insertGirlscout = $connection->prepare($query);
$insertGirlscout-> bind_param("ss", $gsname, $troop);

// Select from girlscout
$query = "SELECT gs_id from girlscout where gsname=?";
$selectGirlscout = $connection->prepare($query);
$selectGirlscout->bind_param('s', $gsname);

// insert into customer
$query = "INSERT INTO customer (fname, lname, street, city, state, zipcode, phone, email)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$insertCustomer = $connection->prepare($query);
$insertCustomer -> bind_param ("sssssiss", $fname, $lname,
                    $street, $city, $state, $zipcode, $phone, $email);

// Select customer
$query = "SELECT id FROM customer WHERE fname=? AND lname=?";
$selectCustomer = $connection->prepare($query);
$selectCustomer->bind_param("ss", $fname, $lname);


?>
