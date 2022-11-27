<?php 
    function place_order($customerID, $taxAmount, $totalPrice, $shipAddress){
        global $db;
        $query = "INSERT INTO orders (customerID, orderDate, taxAmount, totalPrice, shipAddress, shipStatus)
                    VALUES (:customerID, :orderDate, :taxAmount, :totalPrice, :shipAddress, :shipStatus)";
        $statement = $db->prepare($query);
        $statement->execute(array(
                            'customerID' => $customerID,
                            'orderDate' => date("m-d-Y"),  
                            'taxAmount' => $taxAmount, 
                            'totalPrice' => $totalPrice, 
                            'shipAddress' => $shipAddress,
                            'shipStatus' => 0,
                        ));
        $statement->closeCursor();

        $query = "SELECT * FROM orders ORDER BY orderID DESC LIMIT 1";
        $statement = $db->prepare($query);
        $statement->execute();
        $orderID = $statement->fetch();
        $statement->closeCursor();

        return $orderID;
    }

    function orderItems($orderID, $productID, $itemPrice, $quantity){
        global $db;
        $query = 'INSERT INTO orderitems (orderID, productID, itemPrice, quantity)
                    VALUES (:orderID, :productID, :itemPrice, :quantity)';
        $statement = $db->prepare($query);
        $statement->execute(array(
                            'orderID' => $orderID, 
                            'productID' => $productID, 
                            'itemPrice' => $itemPrice, 
                            'quantity' => $quantity
                        ));
        $statement->closeCursor();
    }

    function displayOrders($customerID){
        global $db;
        $query = 'SELECT * FROM orders WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->execute(array('customerID' => $customerID));
        $orders = $statement->fetchAll();
        $statement->closeCursor();

        return $orders;
    }

    function displayOrderItems($orderID){
        global $db;
        $query = "SELECT * FROM orderitems WHERE orderID = :orderID";
        $statement = $db->prepare($query);
        $statement->execute(array('orderID' => $orderID));
        $orderItems = $statement->fetchAll();
        $statement->closeCursor();

        return $orderItems;
    }
?>