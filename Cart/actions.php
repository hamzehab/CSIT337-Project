<?php
    session_start();
    require('../model/db_connect.php');
    require('../model/product_db.php');
    require('../model/order.php');
    
    
    $action = filter_input(INPUT_POST, 'action');
    switch($action){
        case 'view_cart':
            if(!isset($_SESSION['customerID'])) header('location: ../Login/login.php');
            else header('location: view_cart.php');
            break;

        case 'addToCart':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Something went wrong! Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>$error_message</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                $item = array();
                $product = get_product($product_id);
                if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
                if (isset($_SESSION['cart'][$product_id])){
                    if($_SESSION['cart'][$product_id]['quantity'] <= 24) 
                        $_SESSION['cart'][$product_id]['quantity']++;
                }
                else{
                    $item['productID'] = $product_id;
                    $item['categoryID'] = $product['categoryID'];
                    $item['productName'] = $product['productName'];
                    $item['productCode'] = $product['productCode'];
                    $item['price'] = $product['price'];
                    $item['quantity'] = 1;
                    $_SESSION['cart'][$product_id] = $item;
                }
                header('location: view_cart.php');
            }
            break;

        case 'increase':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                if($_SESSION['cart'][$product_id]['quantity'] > 24) $_SESSION['cart'][$product_id]['quantity'] = 25;
                else $_SESSION['cart'][$product_id]['quantity']++;
                header('location: view_cart.php');
            }

            break;

        case 'subtract':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                $_SESSION['cart'][$product_id]['quantity']--;
                if ($_SESSION['cart'][$product_id]['quantity'] == 0) unset($_SESSION['cart'][$product_id]);
                header('location: view_cart.php');
            }
            break;

        case 'manual_entry':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                if ($quantity == 0){
                    unset($_SESSION['cart'][$product_id]);
                    header('location: view_cart.php');
                }
                else{
                    if ($quantity > 25) $_SESSION['cart'][$product_id]['quantity'] = 25;
                    else $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                    header('location: view_cart.php');
                }
            }
            break;

        case 'delete_item':
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            if ($product_id == NULL || $product_id == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                unset($_SESSION['cart'][$product_id]);
                header('location: view_cart.php');
            }
            break;

        case 'order':
            $street = trim(htmlspecialchars(filter_input(INPUT_POST, 'street')));
            $street2 = trim(htmlspecialchars(filter_input(INPUT_POST, 'street2')));
            $city = trim(htmlspecialchars(filter_input(INPUT_POST, 'city')));
            $state = trim(htmlspecialchars(filter_input(INPUT_POST, 'state')));
            $zipCode = trim(htmlspecialchars(filter_input(INPUT_POST, 'zipCode')));

            $taxAmount = filter_input(INPUT_POST, 'taxAmount');
            $totalPrice = filter_input(INPUT_POST, 'totalPrice');

            if ($street == NULL || $street == FALSE || $city == NULL || $city == FALSE || $state == NULL || $state == FALSE || 
                $zipCode == NULL || $zipCode == FALSE || $taxAmount == NULL || $taxAmount == FALSE || $totalPrice == NULL || $totalPrice == FALSE){
                $error_message = "Product not found.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center p-3'><h1>Something went wrong! Product not found.</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
            }
            else{
                $customerID = $_SESSION['customerID'];
    
                if(isset($street2)) $shipAddress = "$street $street2, $city $state $zipCode";
                else $shipAddress = "$street, $city $state $zipCode";
                
                $order['orderID'] = place_order($customerID, $taxAmount, $totalPrice, $shipAddress);
                $orderID = $order['orderID'];

                foreach ($_SESSION['cart'] as $product):
                    orderItems($orderID['orderID'], $product['productID'], $product['price'], $product['quantity']);
                endforeach;
                

                unset($_SESSION['cart']);
                header('location: confirmation.php');
            }
            break;
    }

?>