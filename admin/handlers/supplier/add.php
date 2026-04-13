<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    $response = [];
    $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
    $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
    $supp_telno = mysqli_real_escape_string($conn, $_POST['supp_telno']);

    if ($supp_name == '' || $supp_email == '' || $supp_telno == '') {
        $response = ['msg' => "Please fill out all fields correctly", 'success' => false];
        header('location:../../supplier_table.php');
        exit();
    }


    $query = "INSERT INTO `suppliers`(`supp_name`,`supp_email`,`supp_telno`)VALUES('$supp_name','$supp_email',$supp_telno)";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        $response = ['msg' => "Data added successfully", 'success' => true];
    } else {
        $error = mysqli_errno($conn);
        $response = ['msg' => "Data insertion failed", 'success' => false];
    }

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../supplier_table.php?supp=$is_success");
}
