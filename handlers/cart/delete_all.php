<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {

    if (isset($_SESSION['user_email'])) {

        $email = $_SESSION['user_email'];

        $query = "DELETE FROM `cart` WHERE `u_email`='$email'";
        mysqli_query($conn, $query);

        $_SESSION['success'] = "Deleted Successfully";

        header("Location:../../shopping_cart.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../shopping_cart.php");
    exit();
}
