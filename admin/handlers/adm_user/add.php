<?php
include "../../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_POST) && !empty($_POST)) {

        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_pass = mysqli_real_escape_string($conn, $_POST['user_pass']);
        $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

        if (empty($user_name) || empty($user_email) || empty($user_pass) || empty($role_id)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../user_table.php");
        }

        $query = "INSERT INTO `admin` (`adm_name`,`adm_email`,`adm_pass`,`adm_role`) VALUES('$user_name','$user_email','$user_pass','$role_id')";
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "User Added Successfully";
        }

        header("location:../../user_table.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("location:../../user_table.php");
    exit();
}
