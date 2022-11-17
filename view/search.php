<?php 
    require('./model/product_db.php');
    $search = htmlspecialchars(filter_input(INPUT_POST, 'search'));
    if ($search != ''){
        $products1 = search_product($search); ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo "Website.com Search Results: $search" ?></title>
    </head>
    <body>
    <h3 class="container m-3"><?php echo "Search Results for $search:"; ?></h1>
    <?php if ($products1 != NULL){ ?>
    <div class="container-fluid content-row p-4 col d-flex justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <?php
                        foreach ($products1 as $product): 
                            echo '<div class="box col-lg-4 d-flex align-items-stretch mb-3">'; 
                    ?>
                        <div class="card text-center border-dark" style="width: 100%;">
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
                    <?php 
                        echo '</div>'; endforeach;
                    }
                    else{?>
                </div>
            </div>
        </div>
        <?php 
            echo "<div class='container m-3'> <strong>No Results Found</strong></div>"; }
        }
        ?>
        </body>
</html>