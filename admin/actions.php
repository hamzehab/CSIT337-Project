<?php
    require('../model/db_connect.php');
    require('../model/category_db.php');
    require('../model/product_db.php');

    $action = filter_input(INPUT_POST, 'action');
    switch ($action){
        case 'delete_product':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            if ($category_id == NULL || $category_id == FALSE || $product_id == NULL || $product_id == FALSE) {
                $error = "Missing or incorrect product id or category id.";
                include('../errors/error.php');
            }
            else{
                delete_product($product_id);
                header('location: productManager.php');
            }
            break;
    }
?>