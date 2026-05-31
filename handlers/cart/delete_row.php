<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {

    if (isset($_GET)) {
        $id = $_GET['remove'];

        $query = "DELETE FROM `cart` where `id`=$id";
        $sql = mysqli_query($conn, $query);

        $_SESSION['success'] = "Deleted Successfully";

        header("location:../../shopping_cart.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../shopping_cart.php");
    exit();
}
