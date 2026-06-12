<?php
include "../../sql/conn.php";

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

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../register_users.php");
    exit();
}
