<?php

session_start();
include '../connection.php';


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
        echo  json_encode(['code'=>406,'response'=>$field_error]);
//        $field_error; //redirect user back to login form
    }
    else{

        //check for the field type , if its a username or email
        $db_field = filter_var($dynamic_field, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

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
                echo  json_encode(['code'=>200,'response'=>'user successfully logged In']);
            }
            else
            {
                $_SESSION['field_error'] =  'Password incorrect';
                echo  json_encode(['code'=>406,'response'=>$_SESSION['field_error']]);
            }

        }

        else
        {
            $_SESSION['field_error'] = 'Invalid Credentials | Username invalid';
            echo  json_encode(['code'=>406,'response'=>$_SESSION['field_error']]);
        }
    }

}





