<?php
    session_start();
    if (!isset($_SESSION['customerID'])) header('location: ../Login/Login.php');
    else{
        include ('header.php');
        include('../model/account_db.php');
        include('../model/order.php');
        include('../model/product_db.php');
        $user = user_info($_SESSION['customerID']);
?>
<!DOCTYPE html>
<html>
    <script type="text/javascript">
        function form_submit() {
            document.getElementById("desc").click();
        }    
    </script>
    <body style="background-color: lightgrey;">
        <title>UnlimitedDrinks: Profile</title>
        <div class="container mt-5">
            <div class="border border-light p-3 rounded-5 row bg-light m-5">
                <h2 class="m-3 mb-5"><i style="font-size: 2rem;" class="bi bi-person-circle"></i> Account Info</h2>
                <form action="actions.php" method="POST">
                    <input type="hidden" name="action" value="edit_firstName">
                    <input type="hidden" name="customerID" value="<?php echo $_SESSION['customerID']; ?>">
                    <div class="row ms-5 g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="firstName" placeholder="P" value="<?php echo $user['firstName'] ?>">
                                <label>First Name</label>
                            </div>
                        </div>
                        <div class="col-md mt-3">
                            <button class="btn btn-warning btn-md" type="submit">Edit</button>
                        </div>
                    </div>
                </form>
                <form action="actions.php" method="POST">
                    <input type="hidden" name="action" value="edit_lastName">
                    <input type="hidden" name="customerID" value="<?php echo $_SESSION['customerID']; ?>">
                    <div class="row ms-5 g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="lastName" placeholder="P" value="<?php echo $user['lastName'] ?>" >
                                <label>Last Name</label>
                            </div>
                        </div>
                        <div class="col-md mt-3">
                            <button class="btn btn-warning btn-md" type="submit">Edit</button>
                        </div>
                    </div>
                </form>
                <form>
                    <div class="row ms-5 g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="P" value="<?php echo $_SESSION['email'] ?>" disabled>
                                <label>Email Address</label>
                            </div>
                        </div>
                        <div class="col-md mt-3"></div>
                    </div>
                </form>
                
                <div class="container text-center">
                    <button type="button" class="btn btn-dark p-3" data-bs-toggle="modal" data-bs-target="#editModal">Change Password</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Change Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="actions.php" method="POST" oninput='confirmPassword.setCustomValidity(confirmPassword.value != password.value ? "Passwords do not match." : "")'>
                                <input type="hidden" name="action" value="changePassword">
                                <input type="hidden" name="customerID" value="<?php echo $_SESSION['customerID']; ?>">
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">New Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Confirm Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirmPassword" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button onclick="form_submit()" class='btn btn-primary' name="edit">Change</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="border border-light p-3 rounded-5 row bg-light m-5">
                <h2><i style="font-size: 2rem;" class="bi bi-bag-fill"></i> Orders</h2>
                <?php
                    $count = 0; 
                    $orders = displayOrders($_SESSION['customerID']);
                    if ($orders == NULL){ ?>
                        <div class="m-5">
                            <p>No Orders</p>
                        </div>
                    <?php }

                    foreach ($orders as $order):
                        $orderItems = displayOrderItems($order['orderID']);
                ?>
                        <p><a href="#" data-bs-toggle="modal" data-bs-target="#viewOrderModal<?php echo $count;?>">Order #<?php echo $order['orderID']; ?></a> placed on <?php echo $order['orderDate']; ?></p>
                        <div class="modal fade" id="viewOrderModal<?php echo $count;?>" tabindex="-1" aria-labelledby="viewOrderModallabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="viewOrderModallabel"><?php echo "Order #" . $order['orderID']; ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
            
                                    <div class="modal-body">
                                        <h5>Name</h5>
                                        <p><?php echo $user['firstName'] . " " . $user['lastName']; ?></p>

                                        <h5>Shipping Address</h5>
                                        <p><?php echo "Address: " . $order['shipAddress'];?></p>

                                        <h5>Shipping Status</h5>
                                        <p>
                                            <?php
                                                if ($order['shipStatus'] == 0) echo "Shipping Status: Not Shipped Yet";
                                                else echo "Shipping Status: Not Shipped Yet";
                                            ?>
                                        </p>

                                        <h5>Order Date</h5>
                                        <p><?php echo "Ordered on " . $order['orderDate']; ?></p><br>

                                        <h5>Order Items</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    foreach ($orderItems as $orderItem): 
                                                ?>
                                                <tr>
                                                    <?php $product = get_product($orderItem['productID']); ?>
                                                    <th><img style="width:70px;" src="../images/<?php echo $product['productCode']; ?>.png" alt="<?php echo $product['productName']; ?>"><?php echo $product['productName']; ?></th>
                                                    <td><?php echo "$" . $orderItem['itemPrice']; ?></td>
                                                    <td><?php echo $orderItem['quantity']; ?></td>
                                                    <td><?php $total = $orderItem['itemPrice'] * $orderItem['quantity']; echo "$" . number_format($total, 2, '.')?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <div class="text-end">
                                            <p class="h6" style="font-weight: normal;">Subtotal: &emsp;&emsp; <small class="text-muted">$<?php $subtotal = $order['totalPrice'] - $order['taxAmount']; echo number_format($subtotal, 2, '.')?></small></h6>
                                            <p class="h6" style="font-weight: normal;">Taxes and Fees: &emsp;&emsp; <small class="text-muted">$<?php echo number_format($order['taxAmount'], 2, '.'); ?></small></h6><br>
                                            <p class="h6">Total: &emsp;&emsp; $<?php echo number_format($order['totalPrice'], 2, '.')?></h6>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                <?php $count++; endforeach; ?>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php'); }?>