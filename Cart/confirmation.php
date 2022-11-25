<?php
    session_start();
    require('../model/db_connect.php');
    include('../model/account_db.php');
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <body>
        <title>Order Placed</title>
        <div class="alert alert-success text-center my-5">
            <div class="container my-3">
                <?php $user = user_info($_SESSION['customerID']); ?>
                <h1><?php echo $user['firstName'] . " " . $user['lastName'] . ", Thank you for your order."; ?></h1>
                <br>
                <a href="../customer/view_account.php" class="btn btn-dark">View Order</a>
            </div>
            
        </div>
    </body>
</html>
