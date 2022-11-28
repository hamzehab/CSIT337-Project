<?php 
    include('header.php');
    
    if(isset($_SESSION['adminID'])){ 
        require('../model/db_connect.php');
        include('../model/product_db.php');
        include('../model/account_db.php');
        include('../model/order.php');
        $orders = displayAllOrders();
        $products = display_products();
?>

<!DOCTYPE html>
<html>
    <body>
        <script type="text/javascript">
            function form_submit() {
                document.getElementById("desc").click();
            }    
        </script>
        <title>Order Manager</title>
        <div class="container text-center p-3">
            <h1 class="pb-5">Orders</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Order#</th>
                    <th>Customer</th>
                    <th>Order Date</th>
                    <th>Taxes</th>
                    <th>Total Price</th>
                    <th>Shipping Address</th>
                    <th>Shipping Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php $count = 0; ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['orderID']; ?></td>
                        <td><?php $customer = user_info($order['customerID']); echo $customer['firstName'] . " " . $customer['lastName']; ?></td>
                        <td><?php echo $order['orderDate']; ?></td>
                        <td><?php echo "$" . $order['taxAmount']; ?></td>
                        <td><?php echo "$" . $order['totalPrice']; ?></td>
                        <td><?php echo $order['shipAddress']; ?></td>
                        <td>
                            <?php 
                                $shipStatus = $order['shipStatus'];
                                if ($shipStatus == 0) echo "Not Shipped Yet";
                                else echo "Shipped";
                            ?>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $count;?>">Edit</button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal<?php echo $count; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Product (Please fill each field)</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="actions.php" method="POST">
                                            <input type="hidden" name="action" value="editOrder">
                                            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Order # </label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" value="<?php echo $order['orderID'];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Customer: </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="<?php echo $customer['firstName'] . " " . $customer['lastName']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Order Date: </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="<?php echo $order['orderDate'];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Shipping Address: </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="shipAddress" class="form-control" value="<?php echo $order['shipAddress']; ?>" 
                                                            <?php 
                                                                if ($shipStatus == 0) echo "required";
                                                                else echo "disabled"; 
                                                            ?>>
                                                        </input>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Shipping Status</label>
                                                    <div class="col-sm-10">
                                                        <?php if ($shipStatus == 0){ ?>
                                                        <select class="form-select" name="shipStatus">
                                                            <option value="0">Not Shipped Yet</option>
                                                            <option value="1">Shipped</option>
                                                        </select>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control" value="<?php echo "Shipped"; ?>" disabled>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <?php if($shipStatus == 0){ ?>
                                                <button onclick="form_submit()" class='btn btn-warning' name="edit">Edit</a>
                                                <?php }?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </td>

                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $count; ?>">Delete</button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $count;?>" tabindex="-1" aria-labelledby="deleteModallabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Order</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="actions.php" method="POST">
                                            <input type="hidden" name="action" value="deleteOrder">
                                            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
                                            <input type="hidden" name="customerID" value="<?php echo $order['customerID']; ?>">
                                            <div class="modal-body">
                                                <p>Are you sure you want to complete this action and delete product?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button onclick="form_submit()" class='btn btn-danger' name="edit">Delete</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </td>
                    </tr>
                <?php $count++; endforeach; ?>
            </table>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>