<?php
    session_start();
    require('../model/db_connect.php');
    include('../model/account_db.php');
    
    if(isset($_POST['login'])) $login_error = login_customer();

    if (isset($_SESSION['customerID'])) header('location: ../index.php');
    else{
?>


<!DOCTYPE html>
<html>
    <?php include('../bootstrap.php'); ?>
    <title>Login</title>
    <body style="background-color: lightgrey;">
        <div class="container mt-3">
            <a href="../index.php" class=" btn btn-dark mt-3"><i class="bi bi-arrow-return-left"></i>Back to Homepage</a>
            <div class="text-center pb-5">
                <h1>Login to Unlimited Drinks</h1>
            </div>
            <div class="border border-light p-3 rounded-5 row bg-dark">
                <h4 class="p-3" style="color: white;">Login</h4>
                <?php if(!empty($login_error) && isset($login_error)) echo '<div class="alert alert-danger p-3">' . $login_error. '</div>'; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" type="email" placeholder="Email Address">
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <label for="floatingInput">Password</label>
                    </div>
                    <div class="col text-center p-3">
                        <button name="login" class="btn btn-light">&emsp;Login&emsp;</button><br><br>
                        <a class="link-light" href="./Register.php">Don't have an account? Register here</a><br><br>
                        <a class="link-light" href="./adminLogin.php">Admin Login</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php');} ?>