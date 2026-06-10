<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET) && !empty($_GET)) {
        // variables
        $id = $_GET['id'];
        // variables

        // query
        $query = "DELETE FROM `categories` WHERE `id`=$id";

        // query

        // response
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Subcategory Deleted Successfully";
        } else {
            $_SESSION['error'] = "Subcategory Deletion Failed";
        }
        // response

        header("location:../../subcat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("location:../../subcat_table.php");
    exit();
}
