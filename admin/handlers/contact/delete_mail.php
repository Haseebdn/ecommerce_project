<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET)) {
    $id = base64_decode($_GET['id']);

    if (empty($id)) {

        $_SESSION['error'] = "Invalid Mail";
        header("location:/admin/contact_table.php");
        exit();
    }

    $query = "DELETE FROM `contact_mails` WHERE `id`='$id'";

    try {
        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $_SESSION['success'] = "Mail deleted successfully";
            header("location:/admin/contact_table.php");
            exit();
        } else {

            $_SESSION['error'] = "Deletion Failed";
            header("location:/admin/contact_table.php");
            exit();
        }
    } catch (mysqli_sql_exception) {

        $_SESSION['error'] = "Deletion Failed";
        header("location:/admin/contact_table.php");
        exit();
    }
}
