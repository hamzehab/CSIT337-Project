<?php 
    include('header.php');
    
    if(isset($_SESSION['adminID'])){ 
        require('../model/db_connect.php');
        include('../model/product_db.php');
        include('../model/category_db.php');
        $categories = get_categories();
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
        <title>Product Manager</title>
        <div class="container text-center p-3">
            <h1 class="pb-5">Products</h1>
            <table class="table table-bordered">
                <tr>
                    <th>productID</th>
                    <th>categoryID</th>
                    <th>Code</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>&nbsp;Price&nbsp;</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php $count = 0; ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['productID']; ?></td>
                        <td><?php echo get_category_name($product['categoryID']); ?></td>
                        <td><?php echo $product['productCode']; ?></td>
                        <td><?php echo $product['productName']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo "$" . $product['price']; ?></td>
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
                                            <input type="hidden" name="action" value="edit_product">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">productID:</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" value="<?php echo $product['productID'];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Category Name:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="<?php echo get_category_name($product['categoryID']); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Product Name:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="productName" class="form-control" value="<?php echo $product['productName'];?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Product Description:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="description" class="form-control" value="<?php echo $product['description']; ?>" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Price:</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button onclick="form_submit()" class='btn btn-warning' name="edit">Edit</a>
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
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Product</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="actions.php" method="POST">
                                            <input type="hidden" name="action" value="delete_product">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                            <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
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
        <!-- Button trigger modal -->
        <div class="container">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</button>

            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModallabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addModallabel">Add Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="actions.php" method="POST">
                            <input type="hidden" name="action" value="add_product">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="category_id">
                                        <?php 
                                            foreach ($categories as $category):
                                                $categoryName = $category['categoryName'];
                                                $category_id = $category['categoryID'];
                                                echo "<option value='" . $category_id . "'>$category_id. $categoryName</option>";
                                            endforeach;
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Product Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="productName" class="form-control" required autofocus>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Product Code:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="productCode" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Product Description:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="description" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Price:</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" name="price" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button onclick="form_submit()" class='btn btn-primary' name="add">Add Product</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>