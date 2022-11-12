<?php 
    include('./view/header.php');
    include('./view/search.php');
?>

<!DOCTYPE html>
<html>
    <head></head>
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
            <?php } ?> 
    </body>
</html>