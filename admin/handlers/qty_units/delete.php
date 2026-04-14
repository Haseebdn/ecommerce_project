<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_GET) && !empty($_GET)) {
    $response = [];
    $id=$_GET['id'];

    $query = "DELETE FROM `qty_units` WHERE `id`=$id ";
    $run = mysqli_query($conn, $query);

    if ($run) {
        $response = ['msg' => "Data added successfully", 'qty' => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => 'Data insertion failed', 'qty' => false];
    }
    
    $is_success = $response['qty'] ? 1 : 0;
    header("location:../../qtyUnit_table.php?qty-delete=$is_success");
    exit();
}
