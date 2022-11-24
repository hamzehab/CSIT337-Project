<?php
    session_start();
    if(!isset($_SESSION['customerID'])) header('location: ../Login/Login.php');
    else{
        include('../bootstrap.php');
        require('../model/db_connect.php');
        require('../model/category_db.php');
?>

<!DOCTYPE html>
<html>
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
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                            $categories = get_categories();
                            foreach ($categories as $category): ?>
                        <li><a class="dropdown-item" href="../view_products.php?category_id=<?php
                                echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>                        
                            </a></li>
                        <?php endforeach; ?>
                    </ul>
                  </li>
                  <?php if(isset($_SESSION['adminID'])){ ?>
                      <li class="nav-item">
                        <a class="nav-link active" href="./admin/index.php">Admin View</a>
                      </li>;
                  <?php } ?>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav">
                  <?php if (!isset($_SESSION['email'])){ ?>
                    <li class="nav-item">
                          <a href="./Login/Login.php" class="nav-link" style="font-size: 1.2rem;">Login</a>
                    </li>
                    <li class="nav-item">
                      <a href="./Login/Register.php" class="nav-link" style="font-size: 1.2rem;">Register</a>
                    </li>
                    <?php } else { ?>
                      <li class="nav-item">
                        <a href="./Login/Logout.php" class="nav-link"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-right"></i>Logout</a>
                      </li>
                    <?php } ?>
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <title>Cart</title>
        <section class="h-100 h-custom" style="background-color: #d2c9ff;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black">Shopping Cart <i class="bi bi-cart"></i></h1>
                                <h6 class="mb-0 text-muted">
                                    <?php
                                        if(!isset($_SESSION['cart'])) echo "No items in cart";
                                        else {
                                            $items = count($_SESSION['cart']);
                                            if($items == 1) echo $items . " item"; 
                                            else echo $items . " items";
                                        }
                                    ?>
                                </h6>
                            </div>
                            <hr class="my-4">

                            <?php 
                                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                                    foreach ($_SESSION['cart'] as $product): ?>

                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img src= <?php echo "../images/" . $product['productCode'] . ".png"; ?> class="img-fluid rounded-3" alt="Coca-cola">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <h6 class="text-muted"><?php echo get_category_name($product['categoryID']); ?></h6>
                                    <h6 class="text-black mb-0"><?php echo $product['productName']; ?></h6>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="bi bi-dash"></i>
                                </button>

                                <input id="form1" min="0" name="quantity" value="<?php echo $product['quantity']; ?>" type="number"
                                    class="form-control form-control-sm" />

                                <button class="btn btn-link px-2"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="bi bi-plus"></i>
                                </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h6 class="mb-0"><?php echo "$" . $product['quantity'] * $product['price']; ?></h6>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                </div>
                            </div>

                            <hr class="my-4">
                            <?php endforeach; } ?>

                            <div class="pt-5">
                                <h6 class="mb-0"><a href="../index.php" class="text-body"><i
                                    class="bi bi-arrow-left me-1"></i>Continue Shopping</a></h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-uppercase">items 3</h5>
                                <h5>€ 132.00</h5>
                            </div>

                            <h5 class="text-uppercase mb-3">Shipping</h5>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Total price</h5>
                                <h5>€ 137.00</h5>
                            </div>

                            <button type="button" class="btn btn-dark btn-block btn-lg"
                                data-mdb-ripple-color="dark">Place Order</button>

                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </section>
    </body>
</html>
     
<?php include ('../view/footer.php'); } ?>