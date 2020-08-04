<?php
require_once 'connection.php';

session_start();  //session start to access the session array / variable
$is_logged_in  = isset($_SESSION['logged_in_user']);    //returns either true or false. if the logged_in_user index exists in the $_SESSION array


if($is_logged_in == false)
{
    header('location:auth/index.php');  //redirect the user to the login page
}


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$tables = $connection->query("select * from user_data");

?>

<html lang="en">
<head>
    <title>mysql-data</title>


    <style>
        table {table-layout: fixed;border-collapse: collapse;width: 100%;}
        table, td {border: 1px solid black;padding: 5px;}
        th {background-color: #0d3625;color: white; text-align: center }
        tr:nth-child(even) {background-color: #f2f2f2;}
        .no-border {border: none;}
    </style>
</head>

<body>
        <button style="background-color: darkgreen; margin-left: 90%">
            <a href="auth/logout.php" style="color: white; font-weight: bold">logout</a>
        </button>
        <hr>
    <table style="width: 100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>PhoneNumber</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody style="width: 100%; text-align: center">
        <?php
        while ($row = $tables->fetch_assoc())
        {
            echo '<tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td><a href="'.$row['file_name'].'">Get File</a></td>
                    <td>
                    <a href="request.php?delete='.$row['id'].'" style="color:red">Delete</a>
                    <a href="request.php?edit='.$row['id'].'" style="color: blue">Edit</a>
                    </td>
                </tr>';

        }

        ?>

        </tbody>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>PhoneNumber</th>
            <th>File</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>

</body>
