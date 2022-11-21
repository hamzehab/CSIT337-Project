<?php
    session_start();
    require('../model/db_connect.php');
    include('../model/account_db.php');
    
    if(isset($_POST['register'])) $register_error = register();
    if (isset($_SESSION['customerID'])) header('location: ../index.php');
?>

<!DOCTYPE html>
<html>
    <?php include('../bootstrap.php'); ?>
    <title>Register</title>
    <body style="background-color: #E8E8E8;">
        
        <div class="container mt-3">
            <a href="../index.php" class="btn btn-dark mt-3"><i class="bi bi-arrow-return-left"></i>Back to Homepage</a>
            <div class="text-center pb-5">
                <h1>Registration Unlimited Drinks</h1>
            </div>
            <div class="border border-light p-3 rounded-5 row bg-dark">
                <h4 class="p-3" style="color: white;">Register</h4>
                <?php if(!empty($register_error) && isset($register_error)) echo '<div class="alert alert-danger p-3">' . $register_error. '</div>'; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" oninput='confirmPassword.setCustomValidity(confirmPassword.value != password.value ? "Passwords do not match." : "")'>
                    <div class="form-floating mb-3">
                        <input type="text" name="fName" class="form-control" placeholder="First Name">
                        <label for="floatingInput">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="lName" class="form-control" placeholder="Last Name">
                        <label for="floatingInput">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" type="email" placeholder="Email Address">
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                        <label for="floatingPassword">Confirm Password</label>
                    </div>
                    <div class="col text-center p-3">
                        <button name="register" class="btn btn-light">&emsp;Register&emsp;</button><br><br>
                        <a class="link-light" href="./Login.php">Already have an account? Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php include('../view/footer.php'); ?>