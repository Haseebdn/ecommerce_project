<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET)) {
        $id = base64_decode($_GET['id']);

        if (empty($id)) {

            $_SESSION['error'] = "Invalid Order";
            header("location:/admin/view_orders.php");
            exit();
        }

        $query = "DELETE FROM `orders` WHERE `id`='$id'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Product Deleted Successfully";
            header("location:/admin/view_orders.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("location:/admin/view_orders.php");
    exit();
}
