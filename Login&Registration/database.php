<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecommerce_db";

    $connect = mysqli_connect(
        $servername, $username, $password, $database
    );

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>