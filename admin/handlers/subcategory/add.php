<?php
include "../../sql/conn.php";

// print_r($_POST);
// die();

if (isset($_POST) && !empty($_POST)) {
    // variables
    $parent_id = $_POST['category_id'];
    $subcat_name = $_POST['cat_name'];
    $description = $_POST['cat_description'];
    // variables

    // validation
    if (empty($parent_id) || empty($subcat_name)) {
        $_SESSION['error'] = "Please Fill All Fields Correctly";
        header("location:../../subcat_table.php");
        exit();
    }
    // validation

    // query
    $query = "INSERT INTO `categories` (`cat_name`,`cat_description`,`parent_id`) VALUES('$subcat_name','$description','$parent_id')";
    // query

    // response
    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Data Insertion Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Insertion Failed";
    }

    // response


    header("location:../../subcat_table.php");
    exit();
}
