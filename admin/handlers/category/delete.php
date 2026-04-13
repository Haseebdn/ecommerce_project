<?php
include "../../sql/conn.php";
// print_r($_GET);
// die();
if (isset($_GET) && !empty($_GET)) {
    // variables
    $response = [];
    $id = $_GET['id'];
    // variables

    // query
    $query = "DELETE FROM `categories` WHERE `id`='$id'";
    $run = mysqli_query($conn, $query);
    // query
    
    // response
    if ($run) {
        $response = ['msg' => "Data Deleted Successfully", "success" => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data Deletion failed. Error: $error", "success" => false];
    }
    // response

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../cat_table.php?delete-success=$is_success");
    exit();
}
