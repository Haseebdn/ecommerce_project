<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_GET) && !empty($_GET)) {
        // id
        $id = $_GET['id'];
        // id

        // query
        $query = "DELETE FROM `qty_units` WHERE `id`=$id ";
        // query


        $run = mysqli_query($conn, $query);

        if ($run && mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = "Unit Deleted Successfully";
        }

        header("location:../../qtyUnit_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();
    
    header("location:../../qtyUnit_table.php");
    exit();
}
