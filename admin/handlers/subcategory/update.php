<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
    $response = [];
    $subcat_id = $_POST['edit_index'];
    $parent_id = $_POST['category_id'];
    $subcat_name = $_POST['cat_name'];
    $description = $_POST['cat_description'];
    // variables

    // validation
    if ($parent_id == '' || $subcat_id == '' || $subcat_name == '' || $description == '') {
        $response = ['msg' => "Please fill out all field correctly", "success" => false];
        header("location:../../subcat_table.php?progress=0");
        exit();
    }
    // validation

    // query
    $query = "UPDATE `categories` SET  `cat_name`='$subcat_name',`cat_description`='$description',`parent_id`='$parent_id' WHERE `id`='$subcat_id'";

    $run = mysqli_query($conn, $query);
    // query

    // response
    if ($run) {
        $response = ['msg' => "Subcategory Updated Successfully", "success" => true];
    } else {
        $error = mysqli_errno($conn);
        $response = ['msg' => "Subcategory Updation Failed  Error:$error", "success" => false];
    }
    // response

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../subcat_table.php?progress=$is_success");
    exit();
}
