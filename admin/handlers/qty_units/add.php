<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
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
    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Data Insertion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Insertion Failed";
    }
    // response
    
    header("location:../../qtyUnit_table.php");
    exit();
}
