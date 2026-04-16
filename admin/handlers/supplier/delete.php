<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET)) {
    // variables
    $id = $_GET['id'];
    // variables

    // query
    $query = "DELETE FROM suppliers WHERE id=$id";
    // query

    // response
    try {
        $run = mysqli_query($conn, $query);

        if ($run && mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = "Data deleted successfully";
        } else {
            $_SESSION['error'] = "Data deletion failed";
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['error'] = "Data deletion failed";
    }
    // response

    header("location:../../supplier_table.php");
    exit();
}
