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

CREATE TABLE orders (
  orderID           INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  orderDate         VARCHAR(60)    NOT NULL,
  taxAmount         DECIMAL(10,2)  NOT NULL,
  totalPrice        DECIMAL(10,2)  NOT NULL, 
  shipAddress       VARCHAR(255)   NOT NULL,
  shipStatus        TINYINT(1)     NOT NULL,
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID)
);

CREATE TABLE orderItems (
  itemID            INT            NOT NULL   AUTO_INCREMENT,
  orderID           INT            NOT NULL,
  productID         INT            NOT NULL,
  itemPrice         DECIMAL(10,2)  NOT NULL,
  quantity          INT            NOT NULL,
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

-- password for admin is 123
INSERT INTO administrators (adminID, emailAddress, password, firstName, lastName) VALUES
('1', 'admin@gmail.com', '$2y$10$pXjF/lSUKk1Ur7Apfk72uucKCY1dcVmMLilT/zzErcsVwwFB47UYW', 'admin', 'owner');

-- password for customer is 123
INSERT INTO customers (customerID, emailAddress, password, firstName, lastName) VALUES
('1', 'test@test.com', '$2y$10$pXjF/lSUKk1Ur7Apfk72uucKCY1dcVmMLilT/zzErcsVwwFB47UYW', 'Test', 'Tester');

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
('1', 'gingerale', 'Canada Dry Ginger Ale', "Made with the crisp, refreshing ginger taste you've always loved, Canda Dry Dinger Ale is an unparalleled classic.", '1.99'),
('2', 'bangCC', 'Bang Cotton Candy', "Experience the excitement of a carnival adventure in this flavor-packed energy drink. Your ultimate thrill ride exists with each drop! • 300 mg of caffeine • EAA Aminos • CoQ10 • Super Creatine® - Creatyl-L-Leucine (Creatine bonded to L-Leucine)", '2.99'),
('2', 'bangPM', 'Bang Peach Mango', "This delicious masterpiece can help suit any craving with a taste that can only be found in paradise. Enjoy the delectable thrill of a true tropical sensation! • 300 mg of caffeine • EAA Aminos • CoQ10 • Super Creatine® - Creatyl-L-Leucine (Creatine bonded to L-Leucine)", '2.99'),
('2', 'bangSB', 'Bang Star Blast', "Get the ultimate energy kick from Ol’ glory herself. Experience the beautiful taste of the American dream through every sip! • 300 mg of caffeine • EAA Aminos • CoQ10 • Super Creatine® - Creatyl-L-Leucine (Creatine bonded to L-Leucine)", '2.99'),
('2', 'celsiusO', 'Celsius Sparkling Orange', "Start your day feeling refreshed and re-energized while enjoying the rich, juicy flavor of oranges! Made with clinically proven ingredients, this carbonated flavor of CELSIUS has the perfect balance of flavor and energy that serves as an awesome pick-me-up for active lifestyles.", '3.99'),
('2', 'celsiusPV', 'Celsius Peach Vibe', "Enjoy nothing but good vibes with CELSIUS Peach Vibe! Peach Vibe is deliciously sweet and 100% refreshing. Made with clinically proven ingredients, this carbonated flavor of CELSIUS has the perfect balance of flavor and energy that serves as an awesome pick-me-up for active lifestyles.", '3.99'),
('2', 'celsiusWB', 'Celsius Wild Berry', "Give your workout all you've got while enjoying the sweet taste of delicious wild berries! Made with clinically proven ingredients, this carbonated flavor of CELSIUS has the perfect balance of flavor and energy that serves as an awesome pick-me-up for active lifestyles.", '3.99'),
('2', 'redbull', 'Red Bull Energy Drink', "Red Bull Energy Drink is appreciated worldwide by top athletes, busy professionals, college students and travellers on long journeys.", '3.00'),
('2', 'redbullSF', 'Red Bull Sugar Free', "Wiiings without sugars: Red Bull Sugarfree is Red Bull Energy Drink without sugars.", '3.00'),
('2', 'monster', 'Original Green Monster Energy', "Tear into a can of the meanest energy drink on the planet, Monster Energy. It's the ideal combo of the right ingredients in the right proportion to deliver the big bad buzz that only Monster can. Monster packs a powerful punch but has a smooth easy drinking flavor. Athletes, musicians, anarchists, co-ed’s, road warriors, metal heads, geeks, hipsters, and bikers dig it- you will too. Flavor Profile: Sweet and Salty - It tastes like Monster! Unleash The Beast!", '3.29'),
('2', 'monsterb', 'Monster Energy Ultra Blue', "Aspen, Chamonix, Park City, Whistler, Mammoth…the list goes on. The competition & training circuit has taken the team on some epic snow trips. In honor of these mountain towns comes Ultra Blue. Best served ice cold from the frosty can, Ultra Blue Monster is sugar free and lighter-tasting with zero calories and a full-load of our Monster energy blend. From first chair to last call… Flavor Profile: Light Citrus and Berry Unleash The Ultra Beast!", '3.29'),
('3', 'xxx', 'Acai Blueberry Pomegranate', 'Great taste. More nutrients. Winwin. Vitamin and nutrient-enhanced water beverage with electrolytes and other good stuff. With three types of antioxidants to help fight free radicals: vitamin-a, vitamin-c and selenium. Plus a great source of vitamin b5, vitamin b6, and vitamin b12. The delicious taste of açai-blueberry-pomegranate flavor with other natural flavors multi-pack ring carrier contains 50% post-consumer recycled content.', '2.49'),
('3', 'focus', 'Kiwi Strawberry', 'Great taste. More nutrients. Win win. Vitamin and nutrient-enhanced water beverage with electrolytes and other good stuff. With 300% daily value of vitamin b5, b6, and b12 and guarana. The delicious taste of kiwi strawberry flavor with other natural flavors', '2.49'),
('3', 'energy', 'Tropical Citrus', 'Great taste. More nutrients. Win win. Get jazzed with 60mg of caffeine. plus a great source of vitamin b5, vitamin b6, and vitamin b12. The delicious taste of tropical citrus flavor with other natural flavors', '2.49'),
('3', 'refresh', 'Tropical Mango', "Great taste. More nutrients. Win win. Vitamin and nutrient-enhanced water beverage with electrolytes and other goodstuff. So many electrolytes, it's sports-drink level of rehydration. plus a great source of vitamin b5, vitamin b6, and vitamin b12. The delicious taste of tropical mango flavor with other natural flavors", '2.49'),
('3', 'essential', 'Orange-orange', 'Great taste. more nutrients. Win win. Vitamin and nutrient-enhanced water beverage with electrolytes and other good stuff. With 250% daily value of vitamin c and 25% daily value of zinc. Plus a great source of vitamin b5, vitamin b6, and vitamin b12​​. The delicious taste of orange-orange flavor with other natural flavors', '2.49'),
('3', 'power-c', 'Dragonfruit', 'Great taste. More nutrients. Win win. Vitamin and nutrient-enhanced water beverage with electrolytes and other good stuff. With 200% daily value of vitamin c, 25% daily value of zinc and taurine. plus a great source of vitamin b5, vitamin b6, and vitamin b12​​. The delicious taste of dragonfruit flavor with other natural flavors. Multi-pack ring carrier contains 50% post-consumer recycled content', '2.49'),
('4', 'bublyL', 'Bubly Lime Sparkling Water', "bubly is an unsweetened sparkling water that playfully instigates fun and positivity in everyday life. Lime, bubly sparkling water pairs crisp, sparkling water with natural fruit flavors to provide a delicious taste with no calories, no sweeteners, all smiles.", '7.99'),
('4', 'bublyGF', 'Bubly Grapefruit Sparkling Water', "bubly is an unsweetened sparkling water that playfully instigates fun and positivity in everyday life. Grapefruit, bubly sparkling water pairs crisp, sparkling water with natural fruit flavors to provide a delicious taste with no calories, no sweeteners, all smiles.", '1.50'),
('4', 'bublyBB', 'Bubly Blackberry Sparkling Water', "bubly is an unsweetened sparkling water that playfully instigates fun and positivity in everyday life. Blackberry, bubly sparkling water pairs crisp, sparkling water with natural fruit flavors to provide a delicious taste with no calories, no sweeteners, all smiles.", '1.5'),
('4', 'perrier', 'Perrier Sparkling Water', "Elegant and refreshing. PERRIER Carbonated Mineral Water has delighted generations of beverage seekers, with its blend of bubbles and balanced mineral content for over 150 years. Originating in France, its effervescent spirit is known worldwide. It also offers a great alternative to carbonated soft drinks, with no sugar and zero calories. PERRIER is thirst-quenching on its own, but its crisp carbonation makes it the perfect partner for cocktails and drink recipes. It’s the ideal at-home or on-the-go beverage, making it a refreshing choice for every day.", '2.49'),
('4', 'pellegrino', 'S.Pellegrino Sprakling Water', "The perfect size for sharing at the table with a delicious meal, the 750mL glass bottle is ideal for a relaxing family meal or an elegant lunch with friends.", '1.79'),
('4', 'saratoga', 'Saratoga Sparkling Water - 28oz', "Saratoga Sparkling Spring Water is the perfect balance of light taste with just the right amount of carbonation.  The champagne-like bubbles help cleanse the palate and complement the flavors of fine food and wine.", '2.59'),
('5', 'fuze', 'Fuze Iced Tea w/ Lemon', "Lemon, meet Sweet Tea, Sweet Tea, meet Lemon. BAM! That's a match made in flavor heaven.", '1.99'),
('5', 'teavana', 'Teavana Mango Black Tea', "We start with fine black tea then blend it with refreshing mango notes and hints of crisp lime, giving your day a refreshing lift.", '1.99'),
('5', 'brisk', 'Brisk Lemon Iced Tea', "The original iced tea with tons of attitude. The one with the bold lemon flavor that kicked iced tea off the back porch and gave it some street cred. Now that's Brisk, baby!", '1.99'),
('5', 'arizona', 'Arizona Lemon Iced Tea', "This is the iced tea that put AriZona on the map. The secret to our success? We keep it simple. AriZona Lemon Tea is made from real black tea and natural lemon flavor that help to create the slightly sweet, refreshing taste of sun brewed tea style.", '1.99'),
('5', 'pureleaf', 'Pure Leaf Unsweetened Black Tea', "Taste iced tea the way it was meant to be: brewed from real tea leaves steeped in water and bottled without adding sugar or color. All so you can enjoy the delicious fresh-brewed taste.", '1.99');



CREATE USER IF NOT EXISTS mgs_user@localhost 
IDENTIFIED BY 'pa55word';

-- grant privileges to the user
GRANT SELECT, INSERT, UPDATE, DELETE
ON * 
TO mgs_user@localhost;