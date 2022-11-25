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
    <script type="text/javascript">
        function form_submit() {
            document.getElementById("desc").click();
        }    
    </script>
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
                    <li class="nav-item">
                        <button class="btn btn-dark"><a href="../Login/Logout.php" class="nav-link"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-right"></i>Logout</a></button>
                    </li>
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <title>Cart</title>
        <section class="h-100 h-custom" style="background-color: lightgrey;">
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
                                $count = 0;
                                $total = 0; 
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
                                <div class="col-xl-3 col-lg-3 col-xl-2 d-flex">
                                    <form action="actions.php" method="POST">
                                        <input type="hidden" name="action" value="subtract">
                                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                        <button class="btn btn-outline-dark mx-2 my-1"><i class="bi bi-dash"></i></button>
                                    </form>
                                    
                                    <form action="actions.php" method="POST">
                                        <input type="hidden" name="action" value="manual_entry">
                                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                        <input style="width:250%;" type="number" min="0" max="25" name="quantity" value="<?php echo $product['quantity']; ?>" class="form-control form-control-md text-center">
                                    </form>

                                    <form action="actions.php" method="POST">
                                        <input type="hidden" name="action" value="increase">
                                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                        <button class="btn btn-outline-dark mx-5 my-1"><i class="bi bi-plus fa-lg"></i></button>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h6 class="mb-0"><?php $individualTotal = $product['quantity'] * $product['price']; echo "$" . number_format($individualTotal, 2, '.', ' '); $total += $individualTotal; ?></h6>
                                </div>

                                <div class="col-md-1 col-lg-1 col-xl-1">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $count; ?>"><i class="bi bi-trash3"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $count;?>" tabindex="-1" aria-labelledby="deleteModallabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Remove item from cart?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="actions.php" method="POST">
                                                    <input type="hidden" name="action" value="delete_item">
                                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove <?php echo $product['productName']; ?> from your cart?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button onclick="form_submit()" class='btn btn-danger' name="edit">Delete</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <hr class="my-4">
                            <?php $count++; endforeach; } ?>

                            <div class="pt-5">
                                <h6 class="mb-0"><a href="../index.php" class="text-body"><i class="bi bi-arrow-left me-1"></i>Continue Shopping</a></h6>
                            </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4">
                                <h5>
                                    <?php 
                                    if (isset($_SESSION['cart'])){ 
                                        echo count($_SESSION['cart']);
                                        if(count($_SESSION['cart']) == 1) echo " item";
                                        else echo " items";
                                    }
                                    ?>
                                </h5>
                                <h5>$<?php echo number_format($total, 2, '.'); ?></h5>
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <h5>Sales Tax</h5>
                                <h5>$ <?php $tax = $total * .07; echo number_format($tax, 2, '.', ' '); ?></h5>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-5">
                                <h5>Total Price</h5>
                                <h5>$ <?php $total *= 1.07; echo number_format($total, 2, '.', ' '); ?></h5>
                            </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){ ?>
                        <div class="container">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Shipping Information</h3>
                            <form action="actions.php" method="POST">
                                <input type="hidden" name="action" value="order">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="street" type="text" placeholder="Street Address" required>
                                    <label for="floatingInput">Street Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="street2" type="email" placeholder="Street Address 2">
                                    <label for="floatingInput">Street Address Line 2</label>
                                </div>
                                <div class="row">
                                    <div class="col form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="City" name="city" required>
                                        <label for="floatingInput">City</label>
                                    </div>
                                    <div class="col form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="State" name="state" required>
                                        <label for="floatingInput">State / Province</label>
                                    </div>
                                    <div class="col form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="ZipCode" name="zipCode" required>
                                        <label for="floatingInput">Postal / Zip Code</label>
                                    </div>
                                </div>
                                <div class="col text-end p-3">
                                    <button class="btn btn-success btn-lg" type="submit">Place Order</button>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
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