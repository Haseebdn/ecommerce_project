<?php
include "../../sql/conn.php";

try {

    if (isset($_POST) && !empty($_POST)) {
        $id = mysqli_real_escape_string($conn, $_POST['edit_index']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_pass = mysqli_real_escape_string($conn, $_POST['user_pass']);
        $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

        if (empty($user_name) || empty($user_email) || empty($user_pass) || empty($role_id) || empty($id)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../../user_form.php");
        }

        $query = "UPDATE `admin` SET `adm_name`='$user_name',`adm_email`='$user_email',`adm_pass`='$user_pass',`adm_role`='$role_id' WHERE `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "User Updated Successfully";
            header("location:../../user_table.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../user_form.php");
    exit();
}
