<?php
session_start();  ///

//var_dump($_SESSION);

?>



<html>
    <head>
        <title>Php-Form </title>
    </head>

<body>

<form method="post"  action="request.php">

    <p style="color: red"><?php echo $_SESSION['name_error'] ?></p>
    <p style="color: red"><?php echo $_SESSION['email_error'] ?></p>
    <p style="color: red"><?php echo $_SESSION['username_error'] ?></p>
    <p style="color: red"><?php echo $_SESSION['phone_error'] ?></p>

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
    <script>//javascript</script>
</html>




