<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "Haseeb430@";
$database = "project";
$port = "3306";

$conn = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$conn) {
    echo "Connection Failed. Error:" . mysqli_connect_error($conn);
    die();
}
