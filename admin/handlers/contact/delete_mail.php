<?php
include "../../sql/conn.php";

try {
    if (isset($_GET)) {
        $id = base64_decode($_GET['id']);

        if (empty($id)) {

            $_SESSION['error'] = "Invalid Mail";
            header("location:/admin/contact_table.php");
            exit();
        }

        $query = "DELETE FROM `contact_mails` WHERE `id`='$id'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Mail Deleted Successfully";
            header("location:/admin/contact_table.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../contact_table.php");
    exit();
}
