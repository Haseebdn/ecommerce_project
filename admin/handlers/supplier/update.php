<?php
include "../../sql/conn.php";


try {

    if (isset($_POST) && !empty($_POST)) {
        // variables
        $id = mysqli_real_escape_string($conn, $_POST['edit_index']);
        $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
        $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
        $supp_telno = mysqli_real_escape_string($conn, $_POST['supp_telno']);
        // variables

        // validation
        if (empty($supp_name) || empty($supp_email) || empty($supp_telno) || empty($id)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header('location:../../supplier_form.php');
            exit();
        }
        // validation

        // query
        $query = "UPDATE `suppliers` SET `supp_name`='$supp_name',`supp_email`='$supp_email',`supp_telno`='$supp_telno' WHERE `id`='$id'";

        // query

        // response
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Supplier Updated Successfully";

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
