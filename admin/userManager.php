<?php 
    include('header.php');
    
    if(isset($_SESSION['adminID'])){ 
        require('../model/db_connect.php');
        include('../model/account_db.php');
        $users = grabUsers();
        $admins = grabAdmins();
?>

<!DOCTYPE html>
<html>
    <body>
        <script type="text/javascript">
            function form_submit() {
                document.getElementById("desc").click();
            }    
        </script>
        <title>User Manager</title>
        <div class="container text-center p-3">
            <h1 class="pb-5">Users</h1>
            <table class="table table-bordered">
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                <?php $count = 0; ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['customerID']; ?></td>
                        <td><?php echo $user['firstName'] . " " . $user['lastName']; ?></td>
                        <td><?php echo $user['emailAddress']; ?></td>

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
                                            <input type="hidden" name="action" value="deleteUser">
                                            <input type="hidden" name="customerID" value="<?php echo $user['customerID']; ?>">
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
        <div class="container text-center p-3 mt-5">
            <h1 class="pb-5">Administrators</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Admin ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
                <?php $count = 0; ?>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?php echo $admin['adminID']; ?></td>
                        <td><?php echo $admin['firstName'] . " " . $admin['lastName']; ?></td>
                        <td><?php echo $admin['emailAddress']; ?></td>
                    </tr>
                <?php $count++; endforeach; ?>
            </table>
        </div>
        <div class="container mb-5">
            <div class="text-center">
                <?php if (isset($_SESSION['adminID']) && $_SESSION['adminID'] == 1){ ?>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Admin</button>
                <?php } ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModallabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addModallabel">Add Admin</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="actions.php" method="POST" oninput='confirmPassword.setCustomValidity(confirmPassword.value != password.value ? "Passwords do not match." : "")'>
                            <input type="hidden" name="action" value="addAdmin">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">First Name: </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="firstName" class="form-control" required autofocus>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Last Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="lastName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" class="form-control" required></input>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Confirm Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirmPassword" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button onclick="form_submit()" class='btn btn-primary' name="add">Add Admin</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>