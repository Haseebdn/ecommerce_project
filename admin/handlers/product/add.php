<?php
include "../../sql/conn.php";

// print_r($_POST);
// print_r($_FILES);
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
    $response = [];
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
    $p_imgs = $_FILES['p_imgs']['name'];
    // variables

    // validation
    if ($cat_id == '' || $subcat_id == '' || $supp_id == '' || $p_code == '' || $p_name == '' || $unit_price == '' || $stock == '' || empty($p_imgs)) {
        $response = ['msg' => "Please fill all fields correctly", 'p' => false];
        header('location:../../product_table.php?p=0');
        exit();
    }
    // validation

    //images
    $pImgs_tmp = $_FILES['p_imgs']['tmp_name'];
    $pImgs_newName = [];
    $pImgs_ext = [];

    if (!empty($p_imgs)) {
        foreach ($p_imgs as $item) {
            $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $response = ['msg' => "Data Insertion failed. Error: Invalid file format", "p" => false];
                header("location:../../product_table.php?p=0");
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


    $query = "INSERT INTO `products` (`cat_id`,`subcat_id`,`supp_id`,`p_code`,`p_name`,`p_description`,`unit_price`,`sale_price`,`qty`,`stock`,`p_imgs`) VALUES ('$cat_id','$subcat_id','$supp_id','$p_code','$p_name','$p_description','$unit_price','$sale_price','$qty','$stock','$newNameP')";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        $response = ['msg' => "Data added successfully", 'p' => true];
    } else {
        $error = mysqli_error($conn);
        $response = ['msg' => "Data insertion failed  Error:$error", 'p' => false];
    }

    $is_success = $response['p'] ? 1 : 0;
    header("location:../../product_table.php?p=$is_success");
    exit();
}
