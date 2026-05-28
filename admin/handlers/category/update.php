<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// print_r($_POST);
// die();
try {
    if (isset($_POST) && !empty($_POST)) {
        // variables
        $id = $_POST['edit_index'];
        $cat_name = $_POST['cat_name'];
        $cat_description = $_POST['cat_description'];
        // variables

        // validation
        if (empty($cat_name) || empty($cat_description)  || empty($id)) {
            $_SESSION['error'] = "Please Fill All Fields ocrrectly";
            header("location:../../cat_table.php");
            exit();
        }
        // validation

        // query
        $query = "UPDATE categories SET `cat_name`='$cat_name',`cat_description`='$cat_description' WHERE `id`=$id";
        // query

        // response
        $run = mysqli_query($conn, $query);

        $_SESSION['success'] = "Data Updated Successfully";
        // response

        header("location:../../cat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error : " . $e->getMessage();

    header("location:../../cat_table.php");
    exit();
}
