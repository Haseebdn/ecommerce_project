<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET)) {
    // variables
    $id = $_GET['id'];
    // variables

    // query
    $query = "DELETE FROM `categories` WHERE `id`=$id";

    // query

    // response
    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Deleted Successfully";
        } else {
            $_SESSION['error'] = "Data Deletion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Deletion Failed";
    }
    // response

    header("location:../../subcat_table.php");
    exit();
}
