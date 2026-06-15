<?php
include "../../sql/conn.php";


try {

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = base64_decode($_GET['id']);

        if (empty($id)) {

            $_SESSION['error'] = "Invalid Item";

            header("location:../../pos_orders.php");
            exit();
        }

        $query = "DELETE FROM `pos_cart`
                  WHERE `id`='$id'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Item Successfully Deleted";

            header("location:../../pos_orders.php");
            exit();
        } else {

            $_SESSION['error'] = "Deletion Failed";

            header("location:../../pos_orders.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../pos_orders.php");
    exit();
}
