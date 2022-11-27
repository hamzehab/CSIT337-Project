<?php
    session_start();
    require('../model/db_connect.php');
    require('../model/account_db.php');

    $action = filter_input(INPUT_POST, 'action');
    switch($action){
        case 'edit_firstName':
            $firstName = trim(htmlspecialchars(filter_input(INPUT_POST, 'firstName')));
            if ($firstName == NULL || $firstName == FALSE) header('location: view_account.php');
            else{
                change_firstName($firstName, $_SESSION['customerID']);
                header('location: view_account.php');
            }
            break;

        case 'edit_lastName':
            $lastName = trim(htmlspecialchars(filter_input(INPUT_POST, 'lastName')));
            if ($lastName == NULL || $lastName == FALSE){
                header('location: view_account.php');
            }
            else{
                change_lastName($lastName, $_SESSION['customerID']);
                header('location: view_account.php');
            }
            break;
        
        case 'changePassword':
            $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));
            $confirmPassword = htmlspecialchars(filter_input(INPUT_POST, 'confirmPassword'));
            if ($password == NULL || $password == FALSE || $confirmPassword == NULL || $confirmPassword == FALSE){
                $error_message = "Something went wrong! Password was not entered.";
                include('../bootstrap.php');
                echo "<title>Error</title>";
                echo "<div class='container text-center alert alert-danger mt-5'><h1>$error_message</h1>";
                echo "<a class='btn btn-dark m-3' href='../index.php'>Go Back</a></div>";
                
            }
            else{
                change_password($password, $_SESSION['customerID']);
                header('location: view_account.php');
            }
            break;

    }

?>