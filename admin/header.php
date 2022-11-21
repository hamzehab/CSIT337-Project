<?php
    session_start();
    if(isset($_SESSION['adminID'])){
?>

<!DOCTYPE html>
<html>
    <?php include('../bootstrap.php'); ?>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <i style="color:white; font-size: 3rem;" class="bi bi-cup-straw"></i>&nbsp; &nbsp;
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Customer View</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manager
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" aria-current="page" href="productManager.php">Product Manager</a></li>
                                <li class="nav-item"><a class="dropdown-item" aria-current="page" href="categoryManager.php">Category Manager</a></li>
                                <li class="nav-item"><a class="dropdown-item" aria-current="page" href="userManager.php">User Manager</a></li>
                                <li class="nav-item"><a class="dropdown-item" aria-current="page" href="orderManager.php">Order Manager</a></li>
                            </ul>
                        </li>
                        </ul>
                        <ul class="navbar-nav">
                        <?php if (isset($_SESSION['email'])){
                            echo ('
                            <li class="nav-item">
                                <a href="../Login/Logout.php" class="nav-link"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-right"></i>Logout</a>
                            </li>
                            ');}
                        ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </body>
</html>

<?php 
    } 
    else include('adminCheck.php');
?>