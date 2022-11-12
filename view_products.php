<?php 
    /*session_start();
    if(!isset($_SESSION['username'])){
        header("Location:Login.php");
    }*/

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
        <div class="container-fluid content-row p-4 col d-flex justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <?php foreach ($products as $product): 
                    echo '<div class="box col-lg-4 d-flex align-items-stretch mb-3">'; ?>
                        <div class="card text-center border-dark">
                            <img src="<?php echo './images/' . $product['productCode'] . '.png' ?>" class="card-img-top" alt="">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                <p class="card-text"><?php echo $product['description']; ?></p>
                                <h6 class="card-text mt-auto"><?php echo "$". $product['price']; ?></h6>
                                <form action="addToCart.php" method="POST">
                                    <input type="hidden" name="productID" value="<?php echo $product['productID']?>">
                                    <button class="btn mt-auto btn-dark" value="Submit">Add to Cart</a>
                                </form>
                            </div>
                        </div>
                    <?php echo '</div>'; endforeach; }?>
                </div>
            </div>
        </div>
    </body>
</html>