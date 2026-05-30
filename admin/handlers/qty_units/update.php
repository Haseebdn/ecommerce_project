<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
try {

    if (isset($_POST) && !empty($_POST)) {
        // variables
        $id = $_POST['edit_index'];
        $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
        $unit_description = mysqli_real_escape_string($conn, $_POST['unit_description']);
        // variables

        // validation
        if (empty($unit_name)) {
            $_SESSION['error'] = "Please fill all fields correctly";
            header("location:../../qtyUnit_table");
            exit();
        }
        // validation

        // query
        $query = "UPDATE `qty_units` SET `unit_name`='$unit_name',`unit_description`='$unit_description' WHERE `id`=$id ";
        // query

        // response

        $run = mysqli_query($conn, $query);

        $_SESSION['success'] = "Data Updated Successfully";
        // response

        header("location:../../qtyUnit_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();

    header("location:../../qtyUnit_table.php");
    exit();
}
