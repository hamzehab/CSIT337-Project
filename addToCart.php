<?php

    require('./model/db_connect.php');
    require('./model/product_db.php');
    
    $productID = filter_input(INPUT_POST, 'productID');
    $product = get_product($productID);
    echo ($product['productName'] . "&nbsp;$" . $product['price']);

?>