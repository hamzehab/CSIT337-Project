<?php 
    include('./view/header.php');
    include('./view/search.php');
    $random = random_products();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .featured {
                display: flex;
                flex-direction: column;
                background-image: url('./images/homepage.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                height: 500px;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            .featured h2{
                display: inline-block;
                margin: 0;
                width: 1050px;
                font-family: Rockwell, Courier Bold, Courier, Georgia, Times, Times New Roman, serif;
                font-size: 68px;
                color: #FFFFFF;
                padding-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php 
            if (!isset($search) || $search == ''){ ?>
                <div class="container p-4">
                    <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="d-flex justify-content-center">
                                    <img src="./images/colaCh.png" class="d-inline" alt="...">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-center">
                                    <img src="./images/colaChV.png" class="d-inline" alt="...">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-center">
                                    <img src="..." class="d-inline" alt="...">
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    </div>
                    <div class="bg-dark">
                        <div class="bg-dark featured opacity-50">
                            <h2 class="text-white">Available Products</h2>
                        </div>
                    </div>
                    <div class="container-fluid content-row p-4 col d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="row">
                                <?php foreach ($random as $product): 
                                echo '<div class="box col-lg-4 d-flex align-items-stretch mb-3">'; ?>
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
                                <?php echo '</div>'; endforeach; }?>
                            </div>
                        </div>
                    </div>
                </div> 
    </body>
</html>