<?php
require_once 'connection.php';


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$tables = $connection->query("select * from user_data");
//$tables->num_rows

?>

<html>
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
