<?php
include "../../sql/conn.php";



if (isset($_POST) && !empty($_POST)) {
    $response = [];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];

    if ($cat_name == '' || $cat_description == '') {
        $response = ['msg' => "Please fillout values correctly", "success" => false];
        header("location:../../export-table.php?success=0");
        exit();
    }

    $query = "INSERT INTO categories (cat_name, cat_description) 
              VALUES ('$cat_name', '$cat_description')";


    $run = mysqli_query($conn, $query);

    if ($run) {
        $response = ['msg' => "Category Inserted Successfully", "success" => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data Insertion failed. Error: $error", "success" => false];
    }


    $is_success = $response['success'] ? 1 : 0;
    header("location:../../export-table.php?success=$is_success");
    exit();
}
