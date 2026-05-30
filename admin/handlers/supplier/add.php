<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

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
        $run = mysqli_query($conn, $query);
        $_SESSION['success'] = "Data Inserted Successfully";
        // response

        header("location:../../supplier_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error : " . $e->getMessage();

    header("location:../../supplier_table.php");
    exit();
}
