<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_GET) && !empty($_GET)) {
        // variables
        $id = $_GET['id'];
        // variables

        // query
        $query = "DELETE FROM suppliers WHERE id=$id";
        // query

        // response
        $run = mysqli_query($conn, $query);

        if ($run && mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = "Supplier Deleted successfully";
        }
        // response

        header("location:../../supplier_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error : " . $e->getMessage();

    header("location:../../supplier_table.php");
    exit();
}
