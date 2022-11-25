<?php 
    function place_order($customerID, $taxAmount, $totalPrice, $shipAddress){
        global $db;
        $query = "INSERT INTO orders (customerID, orderDate, taxAmount, totalPrice, shipAddress)
                    VALUES (:customerID, :orderDate, :taxAmount, :totalPrice, :shipAddress)";
        $statement = $db->prepare($query);
        $statement->execute(array
                            ('customerID' => $customerID,
                            'orderDate' => date("Y-m-d h:i:sa"),  
                            'taxAmount' => $taxAmount, 
                            'totalPrice' => $totalPrice, 
                            'shipAddress' => $shipAddress));
        $statement->closeCursor();
    }
?>