<?php
// PDOStatement
$query = "INSERT INTO customer (name, street, city, state, zipcode)
                        VALUES (?,    ?,      ?,    ?,      ?)";

$insertCustomer = $connection -> prepare($query);
$insertCustomer -> bind_param ("ssssi", $name, $street, $city, $state, $zipcode);

$query = "SELECT if FROM customer WHERE name=?";
$selectCustomer = $connection->prepare($query);
$selectCustomer -> bind_param("s", $name);
?>
