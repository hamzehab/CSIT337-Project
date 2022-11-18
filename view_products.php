<?php 
    include('./view/header.php');
    include('./view/search.php');

    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    $products = get_products_by_category($category_id);
    $category_name = get_category_name($category_id);

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo 'Website.com: ' . $category_name; ?></title>
    </head>
    <style>
        
        .card-img-top{
            width: 100%;
            height: 25vw;
            object-fit: cover;
        }

    </style>

    <body>
        <?php if (!isset($search) || $search == ''){ ?>
        <h3 class="m-3"><?php echo $category_name; ?></h1>
        <?php display_search($products);}?>
    </body>
</html>