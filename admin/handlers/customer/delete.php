<?php
include "../../sql/conn.php";
try {
    if (isset($_GET) && !empty($_GET)) {
        $id = $_GET['id'];

        $query = "DELETE FROM `user` WHERE `id`='$id'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            $_SESSION["success"] = "Deleted Successfully";
        }
        header("location:../../register_users.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../register_users.php");
    exit();
}
