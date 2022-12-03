<?php

    function login_admin(){
        global $db;
        $login_error = '';
        $email = trim(htmlspecialchars(filter_input(INPUT_POST, 'email')));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if (empty($email) || empty($password)) $login_error = "All fields are required";
        else{
            $query = "SELECT * FROM administrators WHERE emailAddress = :email";
            $statement = $db->prepare($query);
            $statement->execute(array('email' => $email));
            $user = $statement->fetch();
            $count = $statement->rowCount();
            $statement->closeCursor();

            if($count > 0){
                if (password_verify($password, $user['password'])){
                    $_SESSION['email'] = $email;
                    $_SESSION['adminID'] = $user['adminID'];
                    header('location: index.php');
                }
                else $login_error = "Email or Password is incorrect";
            }
            else{
                $login_error = "Email or Password is incorrect";
            }
        }
        
        return $login_error;
    }

    function login_customer(){
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
                $statement->closeCursor();

                login_customer($email, $password);
                header('location: ../index.php');
            }
        }

        return $register_error;
    }

    function user_info($customerID){
        global $db;
        $query = 'SELECT * FROM customers WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->execute(array('customerID' => $customerID));
        $user = $statement->fetch();
        $statement->closeCursor();

        return $user;
    }

    function change_firstName($firstName, $customerID){
        global $db;
        $query = "UPDATE customers
                    SET firstName = :firstName
                    WHERE customerID = :customerID";
        $statement = $db->prepare($query);
        $statement->execute(array('firstName' => $firstName, 'customerID' => $customerID));
        $statement->closeCursor();
    }

    function change_lastName($lastName, $customerID){
        global $db;
        $query = "UPDATE customers
                    SET lastName = :lastName
                    WHERE customerID = :customerID";
        $statement = $db->prepare($query);
        $statement->execute(array('lastName' => $lastName, 'customerID' => $customerID));
        $statement->closeCursor();
    }

    function change_password($password, $customerID){
        global $db;
        $query = 'UPDATE customers 
                    SET password = :password 
                    WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->execute(array('password' => password_hash($password, PASSWORD_DEFAULT), 'customerID' => $customerID));
        $statement->closeCursor();
    }

    function grabUsers(){
        global $db;
        $query = 'SELECT * FROM customers';
        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();

        return $users;
    }

    function grabAdmins(){
        global $db;
        $query = 'SELECT * FROM administrators';
        $statement = $db->prepare($query);
        $statement->execute();
        $admins = $statement->fetchAll();
        $statement->closeCursor();

        return $admins;
    }

    function addAdmin($firstName, $lastName, $email, $password){
        global $db;
        $query = 'INSERT INTO administrators (emailAddress, password, firstName, lastName)
                    VALUES (:email, :password, :firstName, :lastName)';
        $statement = $db->prepare($query);
        $statement->execute(array('email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'firstName' => $firstName, 'lastName' => $lastName));
        $statement->closeCursor();
    }

    function deleteUser($customerID){
        global $db;
        $query = 'DELETE FROM customers WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->execute(array('customerID' => $customerID));
        $statement->closeCursor();
    }
?>