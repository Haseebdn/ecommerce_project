<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET) && !empty($_GET)) {
        $id = $_GET['id'];

        $query = "DELETE FROM `user` WHERE `id`='$id'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            $_SESSION["success"] = "User Deleted Successfully";
        }
        header("location:../../register_users.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../register_users.php");
    exit();
}
