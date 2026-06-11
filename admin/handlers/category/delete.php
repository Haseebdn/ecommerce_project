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
            $_SESSION['success'] = "Category Deleted Successfully";
        }
        // response

        header("location:../../cat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../cat_form.php");
    exit();
}
