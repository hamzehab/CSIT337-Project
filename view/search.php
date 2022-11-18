<?php 
    require('./model/product_db.php');
    $search = htmlspecialchars(filter_input(INPUT_POST, 'search'));
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo "Website.com Search Results: $search" ?></title>
    </head>
    <body>
        <?php
            if ($search != ''){
                $products = search_product($search);  
                echo "<h3 class='container m-3'>Search Results for " . $search. ": </h1>";

                if ($products != NULL) display_search($products);
                else echo "<div class='container m-3'> <strong>No Results Found</strong></div>";
            }
        ?>

    </body>
</html>