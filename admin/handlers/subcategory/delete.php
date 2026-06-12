<?php
include "../../sql/conn.php";

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
            
            header("location:../../subcat_table.php");
            exit();
        } 
        // response

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../subcat_table.php");
    exit();
}
