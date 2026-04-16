<?php
include "../../sql/conn.php";


// print_r($_POST);
// die();
if (isset($_POST) && !empty($_POST)) {
    // variables
    $id = $_POST['edit_index'];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];
    // variables

    // validation
    if (empty($cat_name) || empty($cat_description)  || empty($id)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header("location:../../cat_table.php");
        exit();
    }
    // validation

    // query
    $query = "UPDATE categories SET `cat_name`='$cat_name',`cat_description`='$cat_description' WHERE `id`=$id";
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

    header("location:../../cat_table.php");
    exit();
}
