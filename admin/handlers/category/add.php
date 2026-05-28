<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


try {
    if (!empty($_POST)) {

        // variables
        $cat_name = trim(mysqli_real_escape_string($conn, $_POST['cat_name']));
        $cat_description = trim(mysqli_real_escape_string($conn, $_POST['cat_description']));
        // variables

        //validation
        if (empty($cat_name) || empty($cat_description)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../cat_table.php");
            exit();
        }
        //validation

        //query
        $query = "INSERT INTO  categories (cat_name, cat_description) 
                  VALUES ('$cat_name','$cat_description')";
        //query

        // response

        $run = mysqli_query($conn, $query);

        $_SESSION['success'] = "Data Inserted Successfully";

        // response

        header("location:../../cat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error : " . $e->getMessage();

    header("location:../../cat_table.php");
    exit();
}
