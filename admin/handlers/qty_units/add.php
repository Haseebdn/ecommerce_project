<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    $response = [];
    $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
    $unit_description = mysqli_real_escape_string($conn,$_POST['unit_description']);

    if ($unit_name == '') {
        $response = ['msg' => "Please fill all fields correctly", 'qty' => false];
        header("location:../../qtyUnit_table?qty=0");
        exit();
    }

    $query = "INSERT INTO `qty_units`(`unit_name`,`unit_description`) VALUE ('$unit_name','$unit_description')";
    $run = mysqli_query($conn, $query);

    if ($run) {
        $response = ['msg' => "Data added successfully", 'qty' => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => 'Data insertion failed', 'qty' => false];
    }
    $is_success = $response['qty'] ? 1 : 0;
    header("location:../../qtyUnit_table.php?qty=$is_success");
    exit();
}
