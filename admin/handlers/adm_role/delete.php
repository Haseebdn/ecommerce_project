<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {

    if (isset($_GET) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM `admin_role` WHERE  `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Role Deleted Successfully";
        }

        header("location:../../role_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("location:../../role_table.php");
    exit();
}
