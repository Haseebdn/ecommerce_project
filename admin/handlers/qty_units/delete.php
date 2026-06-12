<?php
include "../../sql/conn.php";


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

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../qtyUnit_table.php");
    exit();
}
