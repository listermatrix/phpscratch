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
        <title>Login</title>
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
                <form method="post" action="login.php" id="login-fom">
                <h4>Welcome back. , Login</h4>
                <input type="text" id="userName" name="dynamic_field" class="form-control input-sm chat-input" placeholder="username or email" />
                </br>
                <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
                </br>
                <div class="wrapper">
            <span class="group-btn">
                <button  class="btn btn-primary btn-md" type="submit">login <i class="fa fa-sign-in"></i></button>



                <a  href="register.php" class="btn btn-danger btn-md" type="submit">Sign Up <i class="fa fa-user"></i></a>
            </span>

                </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            const loginForm = $('#login-fom'),-->
<!--                url = '../resources/login_api.php';-->
<!---->
<!--            loginForm.on('submit',function (t) {  //to stop the form from submitting-->
<!--                t.preventDefault();-->
<!--               let  form_data = loginForm.serialize();-->
<!---->
<!--                //then make ajax call-->
<!--                $.post(url,form_data,function (data) {-->
<!--                    let output = JSON.parse(data)  //decode the encoded response to json-->
<!--                    console.log(output)-->
<!--                    console.log(output.code)-->
<!--                    if(output.code === 200)-->
<!--                    {-->
<!--                      window.location.replace('../table.php')  //redirect to table.php-->
<!--                    }-->
<!--                    else-->
<!--                    {-->
<!--                        alert(output.response);-->
<!--                    }-->
<!---->
<!--                })-->
<!--                //then print ajax response-->
<!--                //then redirection to page-->
<!--            })-->
<!--        })-->
<!--    </script>-->
    </body>
</html>
