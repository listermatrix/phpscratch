<?php
$host = 'localhost'; //same as 127.0.0.1
$username = 'root';
$password = 'Oneness123@';
$database = 'php_form';
$port = '3306';  // ??


$connection = new mysqli($host,$username,$password,$database);  //we didnt specify the database name

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
