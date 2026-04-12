<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
    $reponse = [];
    $parent_id = $_POST['category_id'];
    $subcat_name = $_POST['cat_name'];
    $description = $_POST['cat_description'];
    // variables

    // validation
    if ($parent_id == '' || $subcat_name == '' || $description == '') {
        $response = ['msg' => "Please fill out all field correctly", "success" => false];
        header("location:../../subcat_table.php?progress=0");
        exit();
    }
    // validation

    // query
    $query = "INSERT INTO `categories` (`cat_name`,`cat_description`,`parent_id`) VALUES('$subcat_name','$description','$parent_id')";

    $run = mysqli_query($conn, $query);
    // query

    // response
    if ($run) {
        $response = ['msg' => "Subcategory Inserted Successfully", "progress" => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Subcategory Insertion Failed. Error: $error", "progress" => false];
    }
    // response

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../subcat_table.php?progress=$is_success");
    exit();
}
