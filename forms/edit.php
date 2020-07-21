<?php
require_once 'connection.php';
session_start();

$id = $_GET['id'];
$records = $connection->query("select * from user_data where id=$id");
$records = $records->fetch_assoc();

?>



<html>
    <head>
        <title>Php-Form </title>
    </head>

<body>

<form method="post"  action="request.php?id=<?php echo $id ?>" enctype="multipart/form-data">

<!--    <p style="color: red">-->
<!--        --><?php
//
//
//                if(isset($_SESSION['name_error']))
//                {
//                    echo $_SESSION['name_error'];
//                }
//                else{
//                    echo  null;
//                }
//
//        ?>
<!--    </p>-->
<!---->
<!---->
<!--    <p style="color: red">-->
<!--        --><?php
//
//
//          if(isset($_SESSION['email_error']))
//          {
//              echo $_SESSION['email_error'];
//          }
//          else{
//              echo  null;
//          }
//
//        ?><!--</p>-->
<!--    <p style="color: red">  --><?php
//
//
//        if(isset($_SESSION['username_error']))
//        {
//            echo $_SESSION['username_error'];
//        }
//        else{
//            echo  null;
//        }
//
//        ?><!--</p>-->
<!--    <p style="color: red">-->
<!--        --><?php
//
//
//        if(isset($_SESSION['phone_error']))
//        {
//            echo $_SESSION['phone_error'];
//        }
//        else{
//            echo  null;
//        }
//
//        ?><!--</p>-->

    <br>
    <label>Name</label>
    <input type="text" value="<?php echo $records['name'] ?>" name="name">

    <br><br>


    <label>Email</label>
    <input type="text" value="<?php echo $records['email'] ?>" name="email">

    <br><br>


    <label>Username</label>
    <input type="text" value="<?php echo $records['username'] ?>" name="username">


    <br><br>

    <label>Mobile Number</label>
    <input type="number" value="<?php echo $records['phone_number'] ?>" name="phone_number">


    <br><br>
    <label>Upload File (max:2mb)</label>
<!--    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
    <input type="file"  name="user_file" value="file">

    <br><br>

    <input type="submit" value="edit_form" name="editBtn">
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




