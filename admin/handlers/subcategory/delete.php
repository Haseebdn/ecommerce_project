<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET)) {
    // variables
    $id = $_GET['id'];
    $response = [];
    // variables

    // query
    $query = "DELETE FROM `categories` WHERE `cat_id`=$id";

    $run = mysqli_query($conn, $query);
    // query

    // response
    if ($run) {
        $response = ['msg' => "Subcategory deleted successfully", 'success' => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Subcategory deletion failed. Error: $error", 'success' => false];
    }
    // response

    $is_success = $response['success'] ? 1 : 0;
    header("location:../../subcat_table.php?delete-progress=$is_success");
}
