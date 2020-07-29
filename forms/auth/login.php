<?php

//
//$password =  password_hash('password', PASSWORD_DEFAULT);
//var_dump($password);
//exit();


session_start();
require_once '../connection.php';

processLogin($connection);

function processLogin($connection)
{
    $username  = $_POST['username'];
    $password =  $_POST['password'];

    $field_error = null;

    if($username  || $password)
    {
        echo 'hello';
    }

    if(empty($username)  || empty($password))

    {
        $field_error = 'All fields are required';
        $_SESSION['field_error']  = $field_error;
        header('location:index.php');  //redirect user back to login form
    }
    else{

        //query to check if username exist
        $tables = $connection->query("select * from users where username='$username'");
        $count = $tables->num_rows;  //number of results returned from query


        //if number of results is greater than 0  //for user name verification
        if($count == 1)
        {
            //for password verification
            $hashedPassword = $tables->fetch_assoc()['password'];
            if(password_verify($password,$hashedPassword))
            {
                $_SESSION['field_error'] = '';
                header('location:../table.php');
            }
            else
            {
                $_SESSION['field_error'] =  'Password incorrect';
                header('location:index.php');
            }

        }

        else
        {
            $_SESSION['field_error'] = 'Invalid Credentials | Username invalid';
            header('location:index.php');
        }
    }

}



