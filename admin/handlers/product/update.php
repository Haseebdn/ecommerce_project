<?php
include "../../sql/conn.php";

if (isset($_POST) && !empty($_POST)) {

    // variables
    $id = mysqli_real_escape_string($conn, $_POST['edit_index']);
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $subcat_id = mysqli_real_escape_string($conn, $_POST['subcat_id']);
    $supp_id = mysqli_real_escape_string($conn, $_POST['supp_id']);
    $p_code = mysqli_real_escape_string($conn, $_POST['p_code']);
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_description = mysqli_real_escape_string($conn, $_POST['p_description']);
    $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
    $sale_price = mysqli_real_escape_string($conn, $_POST['sale_price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    $p_thumbnail = $_FILES['p_thumbnail']['name'];
    $p_tmp = $_FILES['p_thumbnail']['tmp_name'];

    $p_imgs = $_FILES['p_imgs']['name'];
    $pImgs_tmp = $_FILES['p_imgs']['tmp_name'];

    // fetch old imgs
    $query = "SELECT p_thumbnail, p_imgs FROM products WHERE id=$id";
    $sql = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($sql);

    if (!$record) {
        $_SESSION['error'] = "Record not found";
        header("location:../../product_table.php");
        exit();
    }
    // fetch old imgs


    // thumbnail

    if (!empty($p_thumbnail)) {

        // delete old
        if (!empty($record['p_thumbnail']) && file_exists("../../uploads/thumbnail/" . $record['p_thumbnail'])) {
            unlink("../../uploads/thumbnail/" . $record['p_thumbnail']);
        }

        $ext = strtolower(pathinfo($p_thumbnail, PATHINFO_EXTENSION));
        $thumbnail_name = time() . rand(1, 10000) . '.' . $ext;

        move_uploaded_file($p_tmp, "../../uploads/thumbnail/" . $thumbnail_name);
    } else {
        $thumbnail_name = $record['p_thumbnail'];
    }
    // thumbnail

    // imgs

    if (!empty($p_imgs[0])) {

        // delete old images
        if (!empty($record['p_imgs'])) {
            $oldImgs = explode(',', $record['p_imgs']);
            foreach ($oldImgs as $img) {
                if (file_exists("../../uploads/product_images/" . $img)) {
                    unlink("../../uploads/product_images/" . $img);
                }
            }
        }

        $newImgs = [];

        foreach ($p_imgs as $key => $img) {

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $newName = time() . rand(1, 10000) . '.' . $ext;

            move_uploaded_file($pImgs_tmp[$key], "../../uploads/product_images/" . $newName);

            $newImgs[] = $newName;
        }

        $newNameP = implode(',', $newImgs);
    } else {
        $newNameP = $record['p_imgs'];
    }
    // imgs

    // query
    $query = "UPDATE products SET 
        cat_id='$cat_id',
        subcat_id='$subcat_id',
        supp_id='$supp_id',
        p_code='$p_code',
        p_name='$p_name',
        p_description='$p_description',
        unit_price='$unit_price',
        sale_price='$sale_price',
        qty='$qty',
        stock='$stock',
        p_thumbnail='$thumbnail_name',
        p_imgs='$newNameP'
        WHERE id='$id'
    ";
    // query

    // response
    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Updated Successfully";
        } else {
            $_SESSION['error'] = "Data Update Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Update Failed";
    }
    // response


    header("location:../../product_table.php");
    exit();
}
