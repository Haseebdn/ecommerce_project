<?php
include "../../sql/conn.php";


try {

    if (isset($_POST) && !empty($_POST)) {
        // variables
        $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
        $unit_description = mysqli_real_escape_string($conn, $_POST['unit_description']);
        // variables

        // validation
        if (empty($unit_name)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../qtyUnit_form.php");
            exit();
        }
        // validation

        // query
        $query = "INSERT INTO `qty_units`(`unit_name`,`unit_description`) VALUE ('$unit_name','$unit_description')";
        // query

        // response
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Unit Added Successfully";

            header("location:../../qtyUnit_table.php");
            exit();
        }
        // response

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../qtyUnit_form.php");
    exit();
}
