<?php
include "../../sql/conn.php";

if (!empty($_POST)) {

    // variables
    $cat_name = trim(mysqli_real_escape_string($conn, $_POST['cat_name']));
    $cat_description = trim(mysqli_real_escape_string($conn, $_POST['cat_description']));
    // variables

    //validation
    if (empty($cat_name) || empty($cat_description)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header("location:../../cat_table.php");
        exit();
    }
    //validation

    //query
    $query = "INSERT INTO  categories (cat_name, cat_description) 
              VALUES ('$cat_name','$cat_description')";
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

    header("location:../../cat_table.php");
    exit();
}
