<?php
include "../../sql/conn.php";

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

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../supplier_table.php");
    exit();
}
