<?php
session_start();  //initialise the session  to access all variables
$is_logged_in  = isset($_SESSION['logged_in_user']);    //returns either true or false. if the logged_in_user index exists in the $_SESSION array

if($is_logged_in == true)
{
    session_unset();  //clear all session variables
    session_destroy();   //destroy the session
    header('location:index.php');  //redirect the user to the login page
}
else{   //just redirect the person to the logged in page
    header('location:index.php');  //redirect the user to the login page
}