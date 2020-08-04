<?php

session_start();
require_once '../connection.php';

processRegistration($connection);
function processRegistration($connection)
{

    $name            =  $_POST['name'];
    $email           =  $_POST['email'];
    $username        =  $_POST['username'];
    $password        =  $_POST['password'];
    $passwordConfirm =  $_POST['passwordConfirm'];


    $field_error = null;

    if(empty($name)  || empty($password)  || empty($email)  || empty($password) || empty($passwordConfirm))

    {
        $field_error = 'All fields are required';
        $_SESSION['field_error']  = $field_error;
        header('location:register.php');  //redirect user back to login form
    }
    else{

        $passwordHash  = password_hash($password,PASSWORD_DEFAULT);
        /** @noinspection SqlInsertValues */
        $statement =  "insert into users (name,username,email,password) values ('$name','$username','$email','$passwordHash')";
        $insert = $connection->query($statement);
        if($insert  == true)
        {
            $field_error = '';
            $_SESSION['field_error']  = $field_error;
            header('location:login.php');  //redirect user back to login form
        }
        else{
            $field_error = 'Registration failed kindly try again';
            $_SESSION['field_error']  = $field_error;
            header('location:register.php');  //redirect user back to registration form form
        }
        exit();

    }

}



