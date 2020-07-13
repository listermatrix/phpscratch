<?php

session_start();  //enable sessions for the page in order to access session values


//session_destroy();  //destroy or close the session


//var_dump($_SESSION,'hello');
//    exit();

?>



<html>
    <head>
        <title>Php-Form </title>
    </head>

<body>

<form method="post"  action="request.php">

    <p style="color: red">
        <?php

//                echo $_SESSION['name_error']  ?? null;   //?? symbol is null coelaescing  operator

                if(isset($_SESSION['name_error']))
                {
                    echo $_SESSION['name_error'];
                }
                else{
                    echo  null;
                }

        ?>
    </p>


    <p style="color: red">
        <?php


          if(isset($_SESSION['email_error']))
          {
              echo $_SESSION['email_error'];
          }
          else{
              echo  null;
          }

        ?></p>
    <p style="color: red">  <?php


        if(isset($_SESSION['username_error']))
        {
            echo $_SESSION['username_error'];
        }
        else{
            echo  null;
        }

        ?></p>
    <p style="color: red">
        <?php


        if(isset($_SESSION['phone_error']))
        {
            echo $_SESSION['phone_error'];
        }
        else{
            echo  null;
        }

        ?></p>

    <br>
    <label>Name</label>
    <input type="text" value="" name="name">

    <br><br>


    <label>Email</label>
    <input type="text" value="" name="email">

    <br><br>


    <label>Username</label>
    <input type="text" value="" name="username">


    <br><br>

    <label>Mobile Number</label>
    <input type="number" value="" name="phone_number">

    <br><br>

    <input type="submit" value="submit" name="submit">
    <br>
</form>


</body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
          $.get('https://dog.ceo/api/breeds/image/random',function (data) {
                console.log(data.status)

          })
        })
    </script>
</html>




