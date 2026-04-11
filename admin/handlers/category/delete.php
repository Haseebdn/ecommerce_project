<?php
include "../../sql/conn.php";
// print_r($_GET);
// die();
if (isset($_GET) && !empty($_GET)) {

    $response = [];
    $id = $_GET['id'];

    $query = "DELETE FROM `categories` WHERE `cat_id`='$id'";

    if (mysqli_query($conn, $query)) {
        $response = ['msg' => "Data Deleted Successfully", "success" => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data Deletion failed. Error: $error", "success" => false];
    }

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../export-table.php?delete-success=$is_success");
}
