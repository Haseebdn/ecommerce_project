<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $email=$_SESSION['admin_email'];

        $query = "DELETE FROM `pos_cart`
                  WHERE `adm_email`='$email'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Items successfully deleted";

            header("location:../../pos_orders.php");
            exit();
        } else {

            $_SESSION['error'] = "Deletion Failed";

            header("location:../../pos_orders.php");
            exit();
    }
} catch (mysqli_sql_exception) {

    $_SESSION['error'] = "Deletion Failed";

    header("location:../../pos_orders.php");
    exit();
}
