<?php
include "../../sql/conn.php";

if (isset($_GET) && !empty($_GET['id'])) {
    // id
    $id = $_GET['id'];
    // id

    // query to fetch imgs
    $query = "SELECT p_thumbnail,p_imgs FROM `products` WHERE `id`=$id";
    $sql = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($sql);
    if (!$record) {
        $_SESSION['error'] = "Record not found";
        header("location:../../product_table.php");
        exit();
    }
    // query to fetch imgs

    // thumbnail
    $thumbnail = $record['p_thumbnail'];
    if (file_exists("../../uploads/thumbnail/$thumbnail")) {
        unlink("../../uploads/thumbnail/$thumbnail");
    }
    // thumbnail

    // imgs
    $imgs = $record['p_imgs'];
    $imgs_arr = [];
    if (!empty($imgs)) {
        $imgs_arr = explode(',', $imgs);
    }

    if (!empty($imgs_arr)) {
        foreach ($imgs_arr as $del) {
            if (file_exists("../../uploads/product_images/" . $del)) {
                unlink("../../uploads/product_images/" . $del);
            }
        }
    }

    $query = "DELETE FROM `products` WHERE `id`=$id";

    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Deleted Successfully";
        } else {
            $_SESSION['error'] = "Data Deletion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Deletion Failed";
    }

    header("location:../../product_table.php");
    exit();
}
