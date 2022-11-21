<?php 
    include('header.php');
    
    if(isset($_SESSION['adminID'])){ 
        require('../model/db_connect.php');
        include('../model/product_db.php');
        $products = display_products();
?>

<!DOCTYPE html>
<html>
    <body>
        <title>Product Manager</title>
        <div class="container text-center p-3">
            <h1 class="pb-5">Products</h1>
            <table class="table table-bordered">
                <tr>
                    <th>productID</th>
                    <th>categoryID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['productID']; ?></td>
                        <td><?php echo $product['categoryID']; ?></td>
                        <td><?php echo $product['productName']; ?></td>
                        <td><?php echo $product['productCode']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td>
                            <form action="edit_products.php">
                                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                <button class='btn btn-warning' name="edit">Edit</a>
                            </form>
                            
                        </td>
                        <td>
                            <form action="actions.php" method="POST">
                                <input type="hidden" name="action" value="delete_product">
                                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                <button type="submit" class="btn btn-danger" value="Delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="container p-3">
            <a class='btn btn-dark' href="add_products.php">Add Product</a>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>