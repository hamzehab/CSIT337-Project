DROP DATABASE IF EXISTS UnlimitedDrinks;
CREATE DATABASE UnlimitedDrinks;
USE UnlimitedDrinks;

CREATE TABLE customers (
  customerID        INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(60)    NOT NULL,
  firstName         VARCHAR(60)    NOT NULL,
  lastName          VARCHAR(60)    NOT NULL, 
  PRIMARY KEY (customerID),
  UNIQUE INDEX emailAddress (emailAddress)
);

CREATE TABLE addresses (
  addressID         INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  line1             VARCHAR(60)    NOT NULL,
  line2             VARCHAR(60)               DEFAULT NULL,
  city              VARCHAR(40)    NOT NULL,
  state             VARCHAR(2)     NOT NULL,
  zipCode           VARCHAR(10)    NOT NULL,
  phone             VARCHAR(12)    NOT NULL,
  disabled          TINYINT(1)     NOT NULL   DEFAULT 0,
  PRIMARY KEY (addressID),
  INDEX customerID (customerID)
);

CREATE TABLE orders (
  orderID           INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  orderDate         DATETIME       NOT NULL,
  shipAmount        DECIMAL(10,2)  NOT NULL,
  taxAmount         DECIMAL(10,2)  NOT NULL,
  shipDate          DATETIME                  DEFAULT NULL,
  shipAddressID     INT            NOT NULL,
  billingAddressID  INT            NOT NULL,
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID)
);

CREATE TABLE orderItems (
  itemID            INT            NOT NULL   AUTO_INCREMENT,
  orderID           INT            NOT NULL,
  productID         INT            NOT NULL,
  itemPrice         DECIMAL(10,2)  NOT NULL,
  quantity          INT NOT NULL,
  PRIMARY KEY (itemID), 
  INDEX orderID (orderID), 
  INDEX productID (productID)
);

CREATE TABLE products (
  productID         INT            NOT NULL   AUTO_INCREMENT,
  categoryID        INT            NOT NULL,
  productCode       VARCHAR(10)    NOT NULL,
  productName       VARCHAR(255)   NOT NULL,
  description       TEXT           NOT NULL,
  price         DECIMAL(10,2)  NOT NULL,
  quantity          INT            NOT NULL,
  PRIMARY KEY (productID), 
  INDEX categoryID (categoryID), 
  UNIQUE INDEX productCode (productCode)
);

CREATE TABLE categories (
  categoryID        INT            NOT NULL   AUTO_INCREMENT,
  categoryName      VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE administrators (
  adminID           INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(255)   NOT NULL,
  firstName         VARCHAR(255)   NOT NULL,
  lastName          VARCHAR(255)   NOT NULL,
  PRIMARY KEY (adminID)
);

INSERT INTO categories (categoryName) VALUES
    ('Coca-Cola'),
    ('Fanta'),
    ('Pepsi'),
    ('Sprite');

INSERT INTO products (`categoryID`, `productCode`, `productName`, `description`, `price`, `quantity`) VALUES
('1', 'colaCh', 'Coca-Cola Cherry', 'Enjoy the crisp and refreshing taste of Coca-Cola with sweet, smooth cherry flavor.', '1.99', '100'),
('1', 'colaV', 'Coca-Cola Vanilla', 'Enjoy the crisp and refreshing taste of Coca-Cola with a hint of vanilla.', '1.99', '100'),
('1', 'colaChV', 'Coca-Cola Cherry Vanilla', 'The great taste of Coca-Cola + Cherry and Vanilla = UNBELIEVABLY DELICIOUS. Buy Cherry Vanilla online or find it near you today.', '1.99', '100');


CREATE USER IF NOT EXISTS mgs_user@localhost 
IDENTIFIED BY 'pa55word';

-- grant privileges to the user
GRANT SELECT, INSERT, UPDATE, DELETE
ON * 
TO mgs_user@localhost;