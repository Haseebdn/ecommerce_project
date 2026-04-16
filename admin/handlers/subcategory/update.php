<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
    $subcat_id = $_POST['edit_index'];
    $parent_id = $_POST['category_id'];
    $subcat_name = $_POST['cat_name'];
    $description = $_POST['cat_description'];
    // variables

    // validation
    if (empty($parent_id) || empty($subcat_id) || empty($subcat_name) || empty($description)) {
        $_SESSION['error'] = "Please Fill All Fields Correctly";
        header("location:../../subcat_table.php");
        exit();
    }
    // validation

    // query
    $query = "UPDATE `categories` SET  `cat_name`='$subcat_name',`cat_description`='$description',`parent_id`='$parent_id' WHERE `id`='$subcat_id'";

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
        $_SESSION['error'] = "Data Updation Failed";
    }

    // response


    header("location:../../subcat_table.php");
    exit();
}
