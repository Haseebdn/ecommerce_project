<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    // variables
    $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
    $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
    $supp_telno = mysqli_real_escape_string($conn, $_POST['supp_telno']);
    // variables

    // validation
    if (empty($supp_name) || empty($supp_email) || empty($supp_telno)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header('location:../../supplier_table.php');
        exit();
    }
    //validation 

    //query
    $query = "INSERT INTO `suppliers`(`supp_name`,`supp_email`,`supp_telno`)VALUES('$supp_name','$supp_email',$supp_telno)";
    //query

    // response
    try {
        $run = mysqli_query($conn, $query);

        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Data insertion failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data insertion failed ";
    }
    // response

    header("location:../../supplier_table.php");
    exit();
}
