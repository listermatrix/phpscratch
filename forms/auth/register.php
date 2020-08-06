<?php
session_start();

$errorMessage = $_SESSION["field_error"]  ?? null;

$is_logged_in  = isset($_SESSION['logged_in_user']);    //returns either true or false. if the logged_in_user index exists in the $_SESSION array

if($is_logged_in == true)
{
    header('location:../table.php');  //redirects the user to the dashboard  page
}

?>
<html lang="en">
<head>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Roboto:400);
        body {
            background-color:#fff;
            -webkit-font-smoothing: antialiased;
            font: normal 14px Roboto,arial,sans-serif;
        }

        .container {
            padding: 25px;
            position: fixed;
        }

        .form-login {
            background-color: #EDEDED;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 15px;
            border-color:#d2d2d2;
            border-width: 5px;
            box-shadow:0 1px 0 #cfcfcf;
        }

        h4 {
            border:0 solid #fff;
            border-bottom-width:1px;
            padding-bottom:10px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }

        .wrapper {
            text-align: center;
        }
    </style>
    <title>Register</title>
</head>

<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<body>
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4" style="margin-top: 10%">

            <?php  echo  $errorMessage ? '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>' : null  ?>

            <div class="form-login">
                <form method="post" action="DoRegister.php">
                    <h4>Register with us  !!!!</h4>

                    <input type="text" id="userName" name="name" class="form-control input-sm chat-input" placeholder="Full Name" />
                    </br>

                    <input type="text" id="userName" name="username" class="form-control input-sm chat-input" placeholder="username" />
                    </br>

                    <input type="text" id="userName" name="email" class="form-control input-sm chat-input" placeholder="email" />
                    </br>

                    <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
                    </br>

                    <input type="password" id="userPassword" name="passwordConfirm" class="form-control input-sm chat-input" placeholder="password confirmation" />
                    </br>

                    <div class="wrapper">
                        <span class="group-btn">
                            <a  href="login.php" class="btn btn-primary btn-md" type="submit">Cancel <i class="fa fa-times"></i></a>
                            <button class="btn btn-danger btn-md" type="submit">Submit <i class="fa fa-user"></i></button>
                        </span>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>
