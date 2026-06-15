<?php
include "../../sql/conn.php";


try {

    $email=$_SESSION['admin_email'];

        $query = "DELETE FROM `pos_cart`
                  WHERE `adm_email`='$email'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Items Successfully Deleted";

            header("location:../../pos_orders.php");
            exit();
        } else {

            $_SESSION['error'] = "Deletion Failed";

            header("location:../../pos_orders.php");
            exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();

    header("location:../../pos_orders.php");
    exit();
}
