<?php 
    include_once('./view/header.php');
    include('./view/search.php');

    $products = random_products();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            img{
                width: 100%;

            }
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
    <body style="background-color: lightgrey;">
        <?php 
            if (!isset($search) || $search == ''){ ?>
                <div class="container mt-3">
                    <div class="text-center pt-5">
                        <h2>Welcome to Unlimited Drinks!</h2>
                        <h5 style="font-weight: normal;">
                            Where we have a variety of beverages that are offered in bulk or separately. <br>
                            Browse through our many options that we have listed on the website. Brand names <br>
                            such as Coca-Cola, Sprite, Celsius, Monster, etc. 
                        </h5>
                    </div>
                </div>
                <img class="rounded mx-auto d-block" style="width: 30%;" src="./images/logo.png" alt="">

                <div class="bg-dark">
                    <div class="bg-dark featured opacity-50">
                        <h2 class="text-white">Available Products</h2>
                    </div>
                </div>
                <div class="container mt-3">
                    <div class="row mt-5">
                        <div class="col-sm">
                            <img class='mt-3' src="./images/cocacolalogo.png" alt="Coca-Cola Logo">
                        </div>
                        <div class="col-sm">
                            <img src="./images/redbulllogo.png" alt="Red Bull Logo">
                        </div>
                        <div class="col-sm">
                            <img class='mt-4' src="./images/vitaminwaterlogo.png" alt="Red Bull Logo">
                        </div>
                        <div class="col-sm">
                            <img class='' src="./images/lacroixlogo.png" alt="Red Bull Logo">
                        </div>
                    </div>
                </div>
                    <?php display_search($products);} ?>
                </div> 
    </body>
</html>

<?php include('./view/footer.php');?>