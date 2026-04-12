<?php
include "../../sql/conn.php";


// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    // variables
    $response = [];
    $id = $_POST['edit_index'];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];
    // variables

    // validation
    if ($cat_name == '' || $cat_description == '') {
        $response = ['msg' => "Please fillout values correctly", "success" => false];
        header("location:../../cat_table.php?success=0");
        exit();
    }
    // validation

    // query
    $query = "UPDATE categories SET `cat_name`='$cat_name',`cat_description`='$cat_description' WHERE `cat_id`=$id";
    $run = mysqli_query($conn, $query);
    // query

    // response
    if ($run) {
        $response = ['msg' => "Category Inserted Successfully", "success" => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data Insertion failed. Error: $error", "success" => false];
    }
    // response


    $is_success = $response['success'] ? 1 : 0;
    header("location:../../cat_table.php?success=$is_success");
    exit();
}
