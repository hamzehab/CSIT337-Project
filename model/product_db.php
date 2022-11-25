<?php
    function get_products_by_category($category_id) {
        global $db;
        $query = 'SELECT * FROM products
                WHERE categoryID = :category_id
                ORDER BY productID';
        $statement = $db->prepare($query);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }

    function get_product($product_id) {
        global $db;
        $query = 'SELECT * FROM products
                WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":product_id", $product_id);
        $statement->execute();
        $product = $statement->fetch();
        $statement->closeCursor();
        return $product;
    }

    function delete_product($product_id) {
        global $db;
        $query = 'DELETE FROM products
                WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_product($product_id, $productName, $description, $price){
        global $db;
        $query = 'UPDATE products 
                SET productName = :productName, description = :description, price = :price
                WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->execute(array('product_id' => $product_id, 'productName' => $productName, 'description' => $description, 'price' => $price));
        $statement->closeCursor();
    }

    function add_product($category_id, $productCode, $productName, $price, $description) {
        global $db;
        $query = 'INSERT INTO products
                    (categoryID, productCode, productName, description, price)
                VALUES
                    (:category_id, :productCode, :productName, :description, :price)';
        $statement = $db->prepare($query);
        $statement->execute(array(
                    'category_id' => $category_id, 
                    'productCode' => $productCode,
                    'productName' => $productName,
                    'price' => $price,
                    'description' => $description));
        $statement->closeCursor();
    }

    function search_product($search){
        global $db;
        $query = "SELECT * FROM products p 
                    LEFT JOIN categories c ON c.categoryID = p.categoryID 
                    WHERE p.productName LIKE CONCAT('%', :search, '%') 
                    OR c.categoryName = :search";
        $statement = $db->prepare($query);
        $statement->bindValue(":search", $search);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }

    function display_search($products){ ?>
        <div class='container-fluid content-row p-4 col d-flex justify-content-center'>
            <div class='col-md-10'>
                <div class='row'>
                    <?php foreach ($products as $product): ?>
                        <div class='box col-lg-4 d-flex align-items-stretch mb-3'>
                            <div class='card text-center border-dark' style='width: 100%;'>
                                <img src='./images/<?php echo $product['productCode']; ?>.png' class='card-img-top' alt=''>
                                    <div class='card-body d-flex flex-column'>
                                        <h5 class='card-title'><?php echo $product['productName']; ?></h5>
                                        <p class='card-text'><?php echo $product['description']; ?></p>
                                        <h6 class='card-text mt-auto'> $<?php echo $product['price']; ?></h6>
                                        <form action='./Cart/actions.php' method='POST'>
                                            <input type='hidden' name='action' value='addToCart'>
                                            <input type='hidden' name='product_id' value='<?php echo $product['productID']; ?>'>
                                            <?php if(isset($_SESSION['customerID'])) {?>
                                            <button class='btn mt-auto btn-dark' value='Submit'>Add to Cart</a>
                                            <?php } ?>
                                        </form>
                                    </div>
                            </div>
                        </div> 
                        <?php endforeach;?>
                  </div>
                </div>
              </div>

    <?php }

    function random_products(){
        global $db;
        $query = "SELECT * FROM products ORDER by rand() limit 3";
        $statement = $db->prepare($query);
        $statement->execute();
        $random = $statement->fetchAll();
        $statement->closeCursor();

        return $random;
    }

    function display_products(){
        global $db;
        $query = "SELECT * FROM products ORDER BY productID";
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }
    
?>