<?php
    session_start();
    if (!isset($_SESSION['adminID'])) include('adminCheck.php');
    else{
        require('../model/db_connect.php');
        require('../model/category_db.php');
        require('../model/product_db.php');

        $action = filter_input(INPUT_POST, 'action');
        switch ($action){
            case 'delete_product':
                $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
                $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
                if ($category_id == NULL || $category_id == FALSE || $product_id == NULL || $product_id == FALSE) {
                    $error_message = "Missing or incorrect product id or category id.";
                    include('../errors/database_errors.php');
                    echo "<div class='container text-center'><a class='btn btn-dark' href='./productManager.php'>Go Back</a></div>";
                }
                else{
                    delete_product($product_id);
                    header('location: productManager.php');
                }

                break;

            case 'edit_product':
                $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
                $productName = trim(htmlspecialchars(filter_input(INPUT_POST, 'productName')));
                $description = trim(htmlspecialchars(filter_input(INPUT_POST, 'description')));
                $price = trim(htmlspecialchars(filter_input(INPUT_POST, 'price')));
                if ($productName == NULL || $productName == FALSE || $product_id == NULL || $product_id == FALSE
                    || $description == NULL || $description == FALSE || $price == NULL || $price == FALSE) {
                    $error_message = "Missing fields";
                    include('../errors/database_error.php');
                    echo "<div class='container text-center'><a class='btn btn-dark' href='./productManager.php'>Go Back</a></div>";
                }
                else{
                    edit_product($product_id, $productName, $description, $price);
                    header('location: productManager.php');
                }

                break;

            case 'add_product':
                $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
                $productName = trim(htmlspecialchars(filter_input(INPUT_POST, 'productName')));
                $productCode = trim(htmlspecialchars(filter_input(INPUT_POST, 'productCode')));
                $description = trim(htmlspecialchars(filter_input(INPUT_POST, 'description')));
                $price = trim(htmlspecialchars(filter_input(INPUT_POST, 'price')));
                if ($productName == NULL || $productName == FALSE || $productCode == NULL || $productCode == FALSE || 
                    $category_id == NULL || $category_id == FALSE || $description == NULL || $description == FALSE || 
                    $price == NULL || $price == FALSE) {
                        $error_message = "Missing fields";
                        include('../errors/database_error.php');
                        echo "<div class='container text-center'><a class='btn btn-dark' href='./productManager.php'>Go Back</a></div>";
                }
                else{
                    add_product($category_id, $productCode, $productName, $price, $description);
                    header('location: productManager.php');
                }
                
                break;

            case 'edit_category':
                $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
                $categoryName = trim(htmlspecialchars(filter_input(INPUT_POST, 'categoryName')));
                if ($category_id == NULL || $category_id == FALSE || $categoryName == NULL || $categoryName== FALSE){
                    $error_message = "CategoryID or Category Name missing";
                    include('../errors/database_error.php');
                    echo "<div class='container text-center'><a class='btn btn-dark' href='./categoryManager.php'>Go Back</a></div>";
                }
                else{
                    edit_category($category_id, $categoryName);
                    header('location: categoryManager.php');
                }

                break;

            case 'add_category':
                $categoryName = trim(htmlspecialchars(filter_input(INPUT_POST, 'categoryName')));
                if ($categoryName == NULL || $categoryName== FALSE){
                    $error_message = "Category name is missing from field box";
                    include('../errors/database_error.php');
                    echo "<div class='container text-center'><a class='btn btn-dark' href='./categoryManager.php'>Go Back</a></div>";
                }
                else{
                    add_category($categoryName);
                    header('location: categoryManager.php');
                }

        }
    }   
?>