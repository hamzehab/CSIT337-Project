<?php 
    require('./model/product_db.php');
    $search = htmlspecialchars(filter_input(INPUT_POST, 'search'));

    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id != NULL && $category_id != FALSE) $category_name = get_category_name($category_id);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php 
                if($search != ''){
                    echo "UnlimitedDrinks: $search";
                }
                else {
                    if(isset($category_name)) echo "UnlimitedDrinks: $category_name";
                    else echo 'UnlimitedDrinks';
                }
            ?>
        </title>
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