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
  price             DECIMAL(10,2)  NOT NULL,
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
    ('Soda'),
    ('Energy Drinks'),
    ('Vitamin Water'),
    ('Sparkling Water'),
    ('Iced Tea');

INSERT INTO products (`categoryID`, `productCode`, `productName`, `description`, `price`) VALUES
('1', 'cola', 'Coca-Cola', 'Enjoy the crisp and refreshing taste of Coca-Cola Original.', '1.99'),
('1', 'colaCh', 'Coca-Cola Cherry', 'Enjoy the crisp and refreshing taste of Coca-Cola with sweet, smooth cherry flavor.', '2.99'),
('1', 'colaV', 'Coca-Cola Vanilla', 'Enjoy the crisp and refreshing taste of Coca-Cola with a hint of vanilla.', '2.99'),
('1', 'colaChV', 'Coca-Cola Cherry Vanilla', 'The great taste of Coca-Cola + Cherry and Vanilla = UNBELIEVABLY DELICIOUS. Buy Cherry Vanilla online or find it near you today.', '2.99'),
('1', 'sprite', 'Sprite', "The OG, the flavor that started it all—classic, cool, crisp lemon-lime taste that’s caffeine free with 100% natural flavors.", '1.99'),
('1', 'spriteZ', 'Sprite Zero Sugar', "Who says you can’t do more with less? The iconic great taste of Sprite with zero sugar.", '2.49'),
('1', 'fantaS', 'Fanta Strawberry', "It's a low key chill spontaneous strawberry hang under the radar flavor make the most of every vaporwave daydream thing.", '2.99'),
('1', 'fanta', 'Fanta Orange', "It's a classic iconic flavor inspiration in a bottle passion for life share every moment because embracing what makes you unique makes you cool thing.", '1.99'),
('1', 'gingerale', 'Canada Dry Ginger Ale', "Made with the crisp, refreshing ginger taste you've always loved, Canda Dry Dinger Ale is an unparalleled classic.", '1.99');



CREATE USER IF NOT EXISTS mgs_user@localhost 
IDENTIFIED BY 'pa55word';

-- grant privileges to the user
GRANT SELECT, INSERT, UPDATE, DELETE
ON * 
TO mgs_user@localhost;