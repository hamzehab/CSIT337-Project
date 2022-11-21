<?php
    require('../model/category_db.php');
    include('header.php');
    if (isset($_SESSION['adminID'])){
?>

<!DOCTYPE html>
<html>
    <title>UnlimitedDrinks Admin</title>
    <style>
        img {
            width: 70%;
            height: 70%;
        }

        .featured {
                display: flex;
                flex-direction: column;
                background-image: url('../images/homepage.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                height: 250px;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            .featured h2{
                display: inline-block;
                margin: 0;
                width: 525px;
                font-family: Rockwell, Courier Bold, Courier, Georgia, Times, Times New Roman, serif;
                font-size: 40px;
                color: #FFFFFF;
                padding-bottom: 10px;
            }
    </style>

    <body style="background-color: lightgrey;">
       <div class="bg-dark">
            <div class="bg-dark featured opacity-50">
                <h2 class="text-white">Manager Catalog</h2>
            </div>
        </div>
        
        <div class="container text-center mt-5">
            <div class="row p-5 bg-dark rounded-5">
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/productManager.png" alt="Product Manager">
                    <a class="btn btn-light m-4 p-2" href="productManager.php">Product Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/category.jpg" alt="Category Manager">
                    <a class="btn btn-light m-4 p-2" href="categoryManager.php">Category Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/user.jpg" alt="User Manager">
                    <a class="btn btn-light m-4 p-2" href="userManager.php">User Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/orderManager.png" alt="Order Manager">
                    <a class="btn btn-light m-4 p-2" href="orderManager.php">Order Manager</a>
                </div>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php'); }?>