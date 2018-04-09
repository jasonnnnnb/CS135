ii. List the name of the customer that has made the most orders.
iii. List the name of the customer that has ordered the most cookies. Note, this query is a bit different from the previous query as we are counting cookies not orders.
iv. What is the most popular cookie type? i.e. you will need to look at all orders, and
the quantities of the cookies in the order.
I would recommend you first write these queries and test them in the gsc.sql file before incorporating the queries as part of reports.php.

<?php

// Girlscout that has refered the most customers.
$query = "SELECT gsname
FROM girlscout JOIN orders ON orders.gs_id = girlscout.gs_id
ORDER BY COUNT(gsname) DESC
LIMIT 1";

// ii. List the name of the customer that has made the most orders.
$query = "SELECT fname, lname FROM customer
JOIN orders ON orders.customer_id = customer.id
ORDER BY COUNT(fname), COUNT(lname) DESC LIMIT 1
";

// iii. List the name of the customer that has ordered the most cookies. Note, this query is a bit different from the previous query as we are counting cookies not orders.
$query = "SELECT fname, lname FROM customer
INNER JOIN orders ON orders.customer_id=customer.id
INNER JOIN cookies ON cookies.order_id = orders.id
GROUP BY orders.customer_id
ORDER BY SUM(cookies.quantity) DESC
LIMIT 1
";

// iv. What is the most popular cookie type?
// i.e. you will need to look at all orders, and
// the quantities of the cookies in the order.
$query = "SELECT variety FROM cookies
GROUP BY variety
ORDER BY SUM(quantity) DESC
LIMIT 1
";
