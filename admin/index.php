<?php
    session_start();
    
    require('../model/category_db.php');
    
    if (!isset($_SESSION['adminID'])){
        header('refresh:5; url= ../login/login.php');
        echo "<div class=alert alert-danger> You do NOT have access to this page. Page will automatically redirect to Login form </div>";
    }

    else{
        include('header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

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

    <body>
       <div class="bg-dark">
            <div class="bg-dark featured opacity-50">
                <h2 class="text-white">Manager Catalog</h2>
            </div>
        </div>
        
        <div class="container text-center mt-5">
            <div class="row p-5 bg-dark rounded-5">
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/productManager.png" alt="Product Manager">
                    <a class="btn btn-light m-4 p-2" href="">Product Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/category.jpg" alt="Category Manager">
                    <a class="btn btn-light m-4 p-2" href="">Category Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/user.jpg" alt="User Manager">
                    <a class="btn btn-light m-4 p-2" href="">User Manager</a>
                </div>
                <div class="col pt-5">
                    <img class="rounded-5" src="../images/orderManager.png" alt="Order Manager">
                    <a class="btn btn-light m-4 p-2" href="">Order Manager</a>
                </div>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php'); }?>