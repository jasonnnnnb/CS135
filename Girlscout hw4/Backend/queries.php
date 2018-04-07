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
$query = "INSERT INTO girlscout (name, troop)
          VALUES(?, ?)";
$insertGirlscout = $connection->prepare($query);
$insertGirlscout-> bind_param("ss", $scoutName, $troop);

// Select from girlscout
$query = "SELECT gs_id from girlscout where name=?";
$selectGirlscout = $connection->prepare($query);
$selectGirlscout->bind_param('s', $name);

// insert into customer
$query = "INSERT INTO customer (fname, lname, phone, street, city, state, email, zipcode)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$insertCustomer = $connection->prepare($query);
$insertCustomer -> bind_param ("sssssssi", $fname, $lname, $phone,
                    $street, $city, $state, $email, $zipcode);

// Select customer
$query = "SELECT id FROM customer WHERE fname=?";
$selectCustomer = $connection->prepare($query);
$selectCustomer->bind_param("s", $fname);




?>
