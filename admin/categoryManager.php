<?php 
    include('header.php');
    
    if(isset($_SESSION['adminID'])){ 
        require('../model/db_connect.php');
        include('../model/category_db.php');
        $categories = get_categories();
?>

<!DOCTYPE html>
<html>
    <body>
        <script type="text/javascript">
            function form_submit() {
                document.getElementById("desc").click();
            }    
        </script>
        <title>Category Manager</title>
        <div class="container text-center p-3">
            <h1 class="pb-5">Products</h1>
            <table class="table table-bordered">
                <tr>
                    <th>categoryID</th>
                    <th>Category Name</th>
                    <th></th>
                    
                </tr>
                <?php $count = 0; ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['categoryID']; ?></td>
                        <td><?php echo $category['categoryName']; ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $count;?>">Edit</button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal<?php echo $count; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Category (Please fill each field)</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="actions.php" method="POST">
                                            <input type="hidden" name="action" value="edit_category">
                                            <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">categoryID:</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" value="<?php echo $category['categoryID'];?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Category Name:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="categoryName" class="form-control" value="<?php echo $category['categoryName'];?>" required>
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
                    </tr>
                <?php $count++; endforeach; ?>
            </table>
        </div>
        <!-- Button trigger modal -->
        <div class="container">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Category</button>

            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModallabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addModallabel">Add Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="actions.php" method="POST">
                            <input type="hidden" name="action" value="add_category">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="categoryName" class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button onclick="form_submit()" class='btn btn-primary' name="add">Add Category</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>