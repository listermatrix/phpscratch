<?php

require_once 'connection.php';
//error_reporting(E_ERROR | E_PARSE);
//declare session start
//we will use sessions to store error messages and
// pass them to the view
session_start();



if(isset($_POST['submit']))
{

    validate($_POST);
}


//for opening edit form
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    header("location:edit.php?id=$id");
}

//for deleting user from the database
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $tables = $connection->query("delete from user_data where id=$id");
    header('location:table.php');

}


if(isset($_POST['editBtn']))
{
   updateUserInfo($connection);
}

function validate($params)
{

    $name = $params['name'];
    $email = $params['email'];
    $username = $params['username'];
    $phone_number = $params['phone_number'];



    //name validation
    if(isset($name) && !empty($name))  //we check if the field name is passed and the value is not empty
    {
        $length = strlen($name);

        $chars = str_split($name);


        $name_validation_error =  '';  //by default set validation message to empty string

        foreach ($chars as $char)
        {

           if(is_numeric($char))
           {
               $name_validation_error = 'Name must not contain numbers ';
           }

        }

        if($length < 5)
        {
            $name_validation_error = 'the name must be least 5 chars ';
        }

        $_SESSION['name_error'] = $name_validation_error;

    }
    else{
        $_SESSION['name_error'] = 'the name field is required';
    }



    //email validation
    if(isset($email) && !empty($email))
    {

        $email_validation_error =  '';  //by default set validation message to empty string

        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);  //validates the email and if correct returns the email address else false

         if(!$isValid)
         {
             $email_validation_error = 'This is not a valid email address';
         }


        $_SESSION['email_error'] = $email_validation_error;



    }
    else{
        $_SESSION['email_error'] = 'Email field is required';
    }



    //username
    if(isset($username) && !empty($username))
    {
        $username_validation_error =  '';

        $special_char = preg_match('/[^a-zA-Z\d]/',$username);

        if($special_char)
        {
            $username_validation_error = 'username must not contain any special character';
        }


        $_SESSION['username_error'] =  $username_validation_error;
    }
    else{
        $_SESSION['username_error'] = 'username field is required';
    }


    //phone number
    if(isset($phone_number) && !empty($phone_number))
    {
        //check to make sure is all numbers

        $phone_number_validation_error =  '';

        $phone_val = is_numeric($phone_number);

        if(!$phone_val)
        {
            $phone_number_validation_error = 'Phone number must be numeric';
        }

        $_SESSION['phone_error'] = $phone_number_validation_error;

    }
    else{
        $_SESSION['phone_error'] = 'phone number field is required';
    }




    //if all validation has passed then  process data to database else redirect back to form with errors
    if(!empty($_SESSION['name_error'])  || !empty($_SESSION['email_error'])  || !empty($_SESSION['username_error'])  || !empty($_SESSION['phone_error']))
    {
        header('location:index.php');  //redirect page to index.php
    }
    else
    {
        processData($connection);
    }




}

//save to the database
function processData($connection)
{
    //fields name,username,email
    //mysql connection
    //credentianls
    //database name,
    //insert statement
    //close the connection





    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];



    /** @var insert $statement  */
    $statement =  "insert into user_data (name,username,email,phone_number) values ('$name','$username','$email','$phone_number')";
    $insert = $connection->query($statement);


    header('location:table.php');  //redirect page to index.php


}


function updateUserInfo($connection)
{
    $id = $_GET['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];


//    $uploaddir = '/Users/highpriest/PhpstormProjects/learningPhp/forms/uploads/';
    $uploaddir = 'uploads/';

    $uploadfile = $uploaddir . basename($_FILES['user_file']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['user_file']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload failure!\n";
    }

    echo 'Here is some more debugging info:';
    print_r($_FILES);
    print "</pre>";
    exit();


    /** @noinspection SqlNoDataSourceInspection */
    $statement =  "update   user_data set 
                            name     = '$name' ,  
                            phone_number = '$phone_number' ,  
                            username = '$username',             
                            email    = '$email' where 
                            id = $id;";  //update statement


    $update = $connection->query($statement);
    header('location:table.php');
}


function legacy($connection)
{

    //inset statement

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];


    /** @var delete $statement  */
    $statement =  "delete from user_data where username='$username'";  //delete statement
    $insert = $connection->query($statement);
    var_dump($insert);
    exit();



    $statement =  "update user_data set username='mylpatop' where username='$username'";  //insert statement
    $insert = $connection->query($statement);
    var_dump($insert);
    exit();


    /** @var insert $statement  */
    $statement =  "insert into user_data (name,username,email) values ('$name','$username','$email')";
    $insert = $connection->query($statement);
    var_dump($insert);

    /** @var simple select statement $tables */
    $tables = $connection->query("select * from user_data");
    while ($row = $tables->fetch_assoc())
    {
        echo  $row['name'] .' '.$row['email'].'<br>';
    }
}


