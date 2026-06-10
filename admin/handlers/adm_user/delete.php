<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM `admin` WHERE  `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "User Added Successfully";
        }

        header("location:../../user_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error:" . $e->getmessage();
    header("location:../../user_table.php");
    exit();
}
