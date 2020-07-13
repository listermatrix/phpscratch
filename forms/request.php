<?php
//declare session start
//we will use sessions to store error messages and
// pass them to the view
session_start();
connectoDB();  //database connection function
exit();



validate($_POST);   // get all post parameters




header('location:index.php');  //redirect page to index.php






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




}


//
//1. fill the form,  done
//2. validate data,  done
//3. if successful
//    - save to db
//   else
//   display validation message


//save to the database
function connectoDB()
{
    //fields name,username,email
    //mysql connection
    //credentianls
    //database name,
    //insert statement
    //close the connection

    $host = 'localhost'; //same as 127.0.0.1
    $username = 'root';
    $password = 'Oneness123@';
    $database = 'php_form';
    $port = '3306';  // ??


    $connection = mysqli_connect($host,$username,$password,$database,$port);

    //look into mysqli connection state success or failed ??

    $connection = new mysqli($host,$username,$password,$database);



//     Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    echo "Connected successfully";


    $tables = $connection->query("select * from user_data where email='ice2@mail.com'");

    while ($row = $tables->fetch_assoc())
    {
       echo  $row['name'] .' '.$row['email'].'<br>';
    }



}


