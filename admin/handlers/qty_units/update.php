<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    $response = [];
    $id=$_POST['edit_index'];
    $unit_name = mysqli_real_escape_string($conn, $_POST['unit_name']);
    $unit_description = mysqli_real_escape_string($conn,$_POST['unit_description']);

    if ($unit_name == '') {
        $response = ['msg' => "Please fill all fields correctly", 'qty' => false];
        header("location:../../qtyUnit_table?qty=0");
        exit();
    }

    $query = "UPDATE `qty_units` SET `unit_name`='$unit_name',`unit_description`='$unit_description' WHERE `id`=$id ";
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
