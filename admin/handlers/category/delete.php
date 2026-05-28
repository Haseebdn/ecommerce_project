<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // id
        $id = $_GET['id'];
        // id

        // query
        $query = "DELETE FROM `categories` WHERE `id`='$id'";
        // query

        // response
        $run = mysqli_query($conn, $query);

        if ($run && mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = "Data Deleted Successfully";
        } else {
            $_SESSION['error'] = "No Data Found";
        }
        // response

        header("location:../../cat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

   $_SESSION['error'] = "Error : " . $e->getMessage();
    header("location:../../cat_table.php");
    exit();
}
