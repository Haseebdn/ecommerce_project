<?php
include "../../sql/conn.php";


try {
    if (isset($_POST) && !empty($_POST)) {
        // variables
        $parent_id = $_POST['category_id'];
        $subcat_name = $_POST['subcat_name'];
        $description = $_POST['subcat_desc'];
        // variables

        // validation
        if (empty($parent_id) || empty($subcat_name)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../subcat_form.php");
            exit();
        }
        // validation

        // query
        $query = "INSERT INTO `categories` (`cat_name`,`cat_description`,`parent_id`) VALUES('$subcat_name','$description','$parent_id')";
        // query

        // response
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Subcategory Added Successfully";
            
            header("location:../../subcat_table.php");
            exit();
        } 
        // response

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../subcat_form.php");
    exit();
}
