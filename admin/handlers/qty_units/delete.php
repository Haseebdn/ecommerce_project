<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_GET) && !empty($_GET)) {
    // id
    $id = $_GET['id'];
    // id

    // auery
    $query = "DELETE FROM `qty_units` WHERE `id`=$id ";
    // auery

    try {
        $run = mysqli_query($conn, $query);

        if ($run && mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = "Data deleted successfully";
        } else {
            $_SESSION['error'] = "Data deletion failed";
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['error'] = "Data deletion failed";
    }


    header("location:../../qtyUnit_table.php");
    exit();
}
