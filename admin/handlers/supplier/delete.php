<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET)) {
    // variables
    $response = [];
    $id = $_GET['id'];
    // variables

    // query
    $query = "DELETE FROM suppliers WHERE id=$id";
    $run = mysqli_query($conn, $query);
    // query
    
    // response
    if ($run) {
        $response = ['msg' => "Data deleted successfully", 'supp' => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data deletion failed", 'supp' => false];
    }
    // response

    $is_success = $response['supp'] ? 1 : 0;
    header("location:../../supplier_table.php?delete-supp=$is_success");
    exit();
}
