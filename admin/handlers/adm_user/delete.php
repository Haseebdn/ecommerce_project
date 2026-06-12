<?php
include "../../sql/conn.php";

try {
    if (isset($_GET) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM `admin` WHERE  `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "User Added Successfully";
        }

        header("location:../../user_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../user_table.php");
    exit();
}
