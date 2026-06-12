<?php
include "../../sql/conn.php";
try {

    if (isset($_GET) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM `admin_role` WHERE  `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Role Deleted Successfully";
            header("location:../../role_table.php");
            exit();
        }

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../role_table.php");
    exit();
}
