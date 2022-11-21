<?php
    header('refresh:5; url= ../login/login.php'); ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <?php include('../bootstrap.php'); ?>
                    <title>Access Denied</title>
                </head>
                <body>
                    <div class="container text-center p-3">
                        
                        <div class="alert alert-danger p-3">
                            <img src="../images/accessDenied.png" alt="Access Denied"><br><br>
                            <p>We're sorry but the page you are trying to access is either not available or you do not have access to. <br> The page will redirect in five seconds to login...</p>
                            <p>If redirect fails: <a href="../login/login.php">Click here to Login</a></p>

                        </div>
                    </div>
                </body>
            </html>
    <?php include('../view/footer.php'); ?>