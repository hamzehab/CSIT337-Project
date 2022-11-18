<?php
    session_start();

    require('./model/db_connect.php'); 
    require('./model/category_db.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

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
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                            $categories = get_categories();
                            foreach ($categories as $category): ?>
                        <li><a class="dropdown-item" href="view_products.php?category_id=<?php
                                echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>                        
                            </a></li>
                        <?php endforeach; ?>
                    </ul>
                  </li>
                </ul>
                <form class="d-flex" method="POST">
                  <input name="search" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav">
                  <?php if (!isset($_SESSION['email'])){
                    echo ('
                    <li class="nav-item">
                          <a href="./Login/Login.php" class="nav-link" style="font-size: 1.2rem;">Login</a>
                    </li>
                    <li class="nav-item">
                      <a href="./Login/Register.php" class="nav-link" style="font-size: 1.2rem;">Register</a>
                    </li>'
                    );}
                    else{
                      echo ('
                      <li class="nav-item">
                        <a href="./Login/Logout.php" class="nav-link"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-right"></i>Logout</a>
                      </li>
                      ');}
                  ?>
                    
                  <li class="nav-item">
                      <a class="nav-link" href="#"><i style="font-size: 1.5rem;" class="bi bi-cart"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </header>
    </body>
</html>
