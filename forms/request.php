<?php
//declare session start
//we will use sessions to store error messages and
// pass them to the view
session_start();

validate($_POST);   // get all post parameters

header('location:index.php');

//var_dump($_SESSION);  //printing all session values

//validation logic

function validate($params)
{
    $name = $params['name'];
    $email = $params['email'];
    $username = $params['username'];
    $phone_number = $params['phone_number'];



    if(isset($name) && !empty($name))
    {
        $length = strlen($name);

        $chars = str_split($name);

        var_dump($chars);

        $name_validation_error =  '';

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


    if(isset($email) && !empty($email))
    {

        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);  //validates the email and if correct returns the email address else false
         if(!$isValid)
         {
             $_SESSION['email_error'] = 'This is not a valid email address';
         }

    }
    else{
        $_SESSION['email_error'] = 'Email field is required';
    }



    //username
    if(isset($username) && !empty($username))
    {
        $special_char = preg_match('/[^a-zA-Z\d]/',$username);
        if($special_char)
        {
            $_SESSION['username_error'] = 'username must not contain any special character';
        }
    }
    else{
        $_SESSION['username_error'] = 'username field is required';
    }


    //phone number
    if(isset($phone_number) && !empty($phone_number))
    {
        //check to make sure is all numbers

        $phone_val = is_numeric($phone_number);

        if(!$phone_val)
        {
            $_SESSION['phone_error'] = 'Phone number must be numeric';
        }

    }
    else{
        $_SESSION['phone_error'] = 'phone number field is required';
    }




}


