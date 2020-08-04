<?php

session_start();
require_once '../connection.php';


processLogin($connection);

function processLogin($connection)
{

    $dynamic_field  = $_POST['dynamic_field'];
    $password =  $_POST['password'];


    $field_error = null;

    if(empty($dynamic_field)  || empty($password))

    {
        $field_error = 'All fields are required';
        $_SESSION['field_error']  = $field_error;
        header('location:index.php');  //redirect user back to login form
    }
    else{

        //check for the field type , if its a username or email
        $db_field = filter_var($dynamic_field, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


//        if(filter_var($dynamic_field, FILTER_VALIDATE_EMAIL)){
//            $db_field = 'email';
//        }
//        else{
//            $db_field = 'username';
//        }


        //query to check if username  or email exist
//        echo  "select * from users where $db_field='$dynamic_field'";
//        exit();
        $tables = $connection->query("select * from users where $db_field='$dynamic_field'");
        $count = $tables->num_rows;  //number of results returned from query


        //if number of results is greater than 0  //for user name verification
        if($count == 1)
        {
            //for password verification
            $results  = $tables->fetch_assoc();
            $hashedPassword = $results['password'];
            if(password_verify($password,$hashedPassword))
            {
                $_SESSION['field_error'] = '';   //set the field error to empty string
                $_SESSION['logged_in_user'] = $dynamic_field;  //we store the username of the logged in user
                header('location:../table.php');  //redirect to table
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



