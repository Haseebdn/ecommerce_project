<?php
include "../../sql/conn.php";
// echo '<pre>';
// print_r($_POST);
// print_r($_FILES);
// echo '</pre>';
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
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
    // variables

    // validation
    if (empty($cat_id) || empty($subcat_id) || empty($supp_id) || empty($p_code) || empty($p_name) || empty($unit_price) || empty($stock) || empty($p_thumbnail)) {
        $_SESSION['error'] = "Please Fill All Fields Correctly";
        header("location:../../product_table.php");
        exit();
    }
    // validation

    // thumbnail
    $thumbnail_name = '';
    if (!empty($p_thumbnail)) {
        $ext = strtolower(pathinfo($p_thumbnail, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $_SESSION['error'] = "Invalid File Format";
            header("location:../../product_table.php");
            exit();
        }
        $thumbnail_name = time() . rand(1, 10000) . '.' . $ext;
        move_uploaded_file($p_tmp, '../../uploads/thumbnail/' . $thumbnail_name);
    }
    // thumbnail

    //images
    $pImgs_tmp = $_FILES['p_imgs']['tmp_name'];
    $pImgs_newName = [];
    $pImgs_ext = [];

    if (!empty($p_imgs)) {
        foreach ($p_imgs as $item) {
            $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $_SESSION['error'] = "Invalid File Format";
                header("location:../../product_table.php");
                exit();
            }
            $pImgs_ext[] = $ext;
        }
    }

    foreach ($pImgs_tmp as $key => $tmp) {
        $pImgs_newName[] = time() . rand(1, 10000) . '.' .  $pImgs_ext[$key];
        move_uploaded_file($tmp, '../../uploads/product_images/' . $pImgs_newName[$key]);
    }
    $newNameP = '';
    $newNameP = implode(',', $pImgs_newName);
    // images

    //query
    $query = "INSERT INTO `products` (`cat_id`,`subcat_id`,`supp_id`,`p_code`,`p_name`,`p_description`,`unit_price`,`sale_price`,`qty`,`stock`,`p_thumbnail`,`p_imgs`) VALUES ('$cat_id','$subcat_id','$supp_id','$p_code','$p_name','$p_description','$unit_price','$sale_price','$qty','$stock','$thumbnail_name','$newNameP')";
    //query

    // response
    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Date Insertion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Insertion Failed";
    }
    // response



    header("location:../../product_table.php");
    exit();
}
