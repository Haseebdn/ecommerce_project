<?php
include "../../sql/conn.php";

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
            header('location:../../supplier_form.php');
            exit();
        }
        //validation 

        //query
        $query = "INSERT INTO `suppliers`(`supp_name`,`supp_email`,`supp_telno`)VALUES('$supp_name','$supp_email',$supp_telno)";
        //query

        // response
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Supplier Added Successfully";
            header("location:../../supplier_table.php");
            exit();
        }
        // response

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../supplier_form.php");
    exit();
}
