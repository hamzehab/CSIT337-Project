<?php
    session_start();
    require('../model/db_connect.php');
    require('../model/product_db.php');
    
    
    $action = filter_input(INPUT_POST, 'action');
    switch($action){
        case 'view_cart':
            if(!isset($_SESSION['customerID'])) header('location: ../Login/login.php');
            else header('location: view_cart.php');
            break;

        case 'addToCart':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                $item = array();
                $product = get_product($product_id);
                if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
                if (isset($_SESSION['cart'][$product_id])){
                    $_SESSION['cart'][$product_id]['quantity']++;
                }
                else{
                    $item['categoryID'] = $product['categoryID'];
                    $item['productName'] = $product['productName'];
                    $item['productCode'] = $product['productCode'];
                    $item['price'] = $product['price'];
                    $item['quantity'] = 1;
                    $_SESSION['cart'][$product_id] = $item;
                }
                header('location: view_cart.php');

            }
    }

?>