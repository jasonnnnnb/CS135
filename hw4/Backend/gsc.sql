DROP DATABASE IF EXISTS GSC;
CREATE DATABASE GSC;
USE GSC;

-- Create the tables

CREATE TABLE girlscout (
  gs_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gsname VARCHAR(256) NOT NULL,
  troop VARCHAR(256) NOT NULL
);


CREATE TABLE customer (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(256) NOT NULL,
  lname VARCHAR(256) NOT NULL,
  street VARCHAR(64) NOT NULL,
  city VARCHAR(64) NOT NULL,
  state VARCHAR(64) NOT NULL,
  zipcode INT UNSIGNED NOT NULL,
  phone VARCHAR(64) NOT NULL,
  email VARCHAR(64) NOT NULL
);

CREATE TABLE orders (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_id INT UNSIGNED NOT NULL,
  gs_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customer(id),
  FOREIGN KEY (gs_id) REFERENCES girlscout(gs_id)
);

CREATE TABLE cookies (
  order_id INT UNSIGNED NOT NULL,
  variety VARCHAR(64) NOT NULL,
  quantity INT SIGNED NOT NULL,
  price INT,
  FOREIGN KEY (order_id) REFERENCES orders(id)
);


-- Running the database:
-- in MAMP, there should be a mysql executable in Libaray/bin
-- specify login info
--
-- source /Applications.... path
