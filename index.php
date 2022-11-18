<?php 
    include('./view/header.php');
    include('./view/search.php');
    $products = random_products();
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
                    <?php display_search($products);} ?>
                </div> 
    </body>
</html>