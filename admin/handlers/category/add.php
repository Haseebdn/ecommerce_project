// add.php
<?php
include "../../sql/conn.php";

try {
    if (!empty($_POST)) {

        $cat_name        = trim(mysqli_real_escape_string($conn, $_POST['cat_name']));
        $cat_description = trim(mysqli_real_escape_string($conn, $_POST['cat_description']));

        if (empty($cat_name)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../cat_form.php");
            exit();
        }

        $query = "INSERT INTO c categories (cat_name, cat_description) 
                  VALUES ('$cat_name', '$cat_description')";

        mysqli_query($conn, $query);

        $_SESSION['success'] = "Category Added Successfully";
        header("location:../../cat_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../cat_form.php");
    exit();
}
