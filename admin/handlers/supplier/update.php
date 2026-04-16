<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    // variables
    $id = mysqli_real_escape_string($conn, $_POST['edit_index']);
    $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
    $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
    $supp_telno = mysqli_real_escape_string($conn, $_POST['supp_telno']);
    // variables

    // validation
    if (empty($supp_name) || empty($supp_email) || empty($supp_telno) || empty($id)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header('location:../../supplier_table.php');
        exit();
    }
    // validation

    // query
    $query = "UPDATE `suppliers` SET `supp_name`='$supp_name',`supp_email`='$supp_email',`supp_telno`='$supp_telno' WHERE `id`='$id'";

    // query

    // response
    try {
        $run = mysqli_query($conn, $query);

        if ($run) {
            $_SESSION['success'] = "Data Updated Successfully";
        } else {
            $_SESSION['error'] = "Data Updation Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Updation Failed ";
    }
    // response

    header("location:../../supplier_table.php");
    exit();
}
