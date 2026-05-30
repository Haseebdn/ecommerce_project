<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST) && !empty($_POST)) {
        // variables
        $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
        $unit_description = mysqli_real_escape_string($conn, $_POST['unit_description']);
        // variables

        // validation
        if (empty($unit_name)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../qtyUnit_table");
            exit();
        }
        // validation

        // query
        $query = "INSERT INTO `qty_units`(`unit_name`,`unit_description`) VALUE ('$unit_name','$unit_description')";
        // query

        // response
        $run = mysqli_query($conn, $query);
        $_SESSION['success'] = "Data Inserted Successfully";
        // response

        header("location:../../qtyUnit_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../qtyUnit_table.php");
    exit();
}
