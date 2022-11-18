<?php
    function login(){
        global $db;
        $login_error = '';
        $email = trim(htmlspecialchars(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if (empty($email) || empty($password)) $login_error = "All fields are required";
        else{
            $query = "SELECT * FROM customers WHERE emailAddress = :email";
            $statement = $db->prepare($query);
            $statement->execute(array('email' => $email));
            $user = $statement->fetch();
            $count = $statement->rowCount();
            $statement->closeCursor();

            if($count > 0){
                if (password_verify($password, $user['password'])){
                    $_SESSION['email'] = $email;
                    $_SESSION['customerID'] = $user['customerID'];
                    header('location: ../index.php');
                }
                else $login_error = "Email or Password is incorrect";
            }
            else{
                $login_error = "Email or Password is incorrect";
            }
        }
        
        return $login_error;
    }

    function register(){
        global $db;
        $register_error = '';
        $fName = trim(htmlspecialchars(filter_input(INPUT_POST, 'fName')));
        $lName = trim(htmlspecialchars(filter_input(INPUT_POST, 'lName')));
        $email = trim(htmlspecialchars(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));
        $confirmPassword = htmlspecialchars(filter_input(INPUT_POST, 'confirmPassword'));
        
        if (empty($fName) || empty($lName) || empty($email) || empty($password) || empty($confirmPassword)) $register_error = "All fields are required";
        else{
            $query = "SELECT * FROM customers WHERE emailAddress = :email";
            $statement = $db->prepare($query);
            $statement->execute(array('email' => $email));
            $count = $statement->rowCount();
            $statement->closeCursor();

            if($count > 0) $register_error = "Email Address already registered";
            else{
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO customers (emailAddress, password, firstName, lastName) 
                            VALUES (:email, :password, :fName, :lName)";
                $statement = $db->prepare($query);
                $statement->execute(array('email' => $email, 'password' => $hash, 'fName' => $fName, 'lName' => $lName));
                $user = $statement->fetch();
                $statement->closeCursor();

                $_SESSION['email'] = $email;
                $_SESSION['customerID'] = $user['customerID'];
                header('location: ../index.php');
            }
        }

        return $register_error;
    }
?>