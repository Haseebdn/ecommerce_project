<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM `admin` WHERE  `id`=$id";

    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Deleted Successfully";
        } else {
            $_SESSION['error'] = "Data Deletion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Deletion Failed";
    }

    header("location:../../user_table.php");
    exit();
}
