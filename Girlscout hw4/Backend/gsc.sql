DROP DATABASE IF EXISTS GSC;
CREATE DATABASE GSC;

GRANT ALL PRIVILEGES ON GSC.* to jason@localhost IDENTIFIED BY 'jason';

USE GSC;

-- Create the tables
CREATE TABLE cookies (
  order_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (order_id) REFERNCES orders(id),
  variety VARCHAR(64),
  quantity INT SIGNED NOT NULL,
  price INT
);

CREATE TABLE orders (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_id INT UNSIGNED NOT NULL,
  gs_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customer(id),
  FOREIGN KEY (gs_id) REFERENCES girlscout(gs_id)
);

CREATE TABLE girlscout (
  gs_id NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name NOT NULL VARCHAR(256),
  troop NOT NULL VARCHAR(256)
);

CREATE TABLE customer (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(256) NOT NULL,
	phone VARCHAR(64) NOT NULL,
  street VARCHAR(64) NOT NULL,
  city VARCHAR(64) NOT NULL,
  state VARCHAR(64) NOT NULL,
  zipcode INT UNSIGNED NOT NULL
);

-- Running the database:
-- in MAMP, there should be a mysql executable in Libaray/bin
-- specify login info
--
-- source /Applications.... path
