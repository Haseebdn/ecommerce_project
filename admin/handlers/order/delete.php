<?php
include "../../sql/conn.php";


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

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../view_orders.php");
    exit();
}
