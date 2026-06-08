<?php
include "../sql/conn.php";
// print_r($_POST);
// die();
try {

    if (isset($_POST)) {
        $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $u_email = mysqli_real_escape_string($conn, $_POST['u_email']);
        $p_number = mysqli_real_escape_string($conn, $_POST['p_number']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);

        if (empty($f_name) || empty($last_name) || empty($u_email) || empty($p_number) || empty($country) || empty($state) || empty($city) || empty($postal_code) || empty($address) || empty($gender)) {
            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("location:../profile_edit.php");
            exit();
        }



        $query = "UPDATE `user`  SET `f_name`='$f_name',`last_name`='$last_name',`p_number`='$p_number', `country`='$country',`state`='$state',`city`='$city',`postal_code`='$postal_code',`address`='$address',`gender`='$gender' WHERE `u_email`='$u_email'";

        $run = mysqli_query($conn, $query);

        if ($run) {
            $_SESSION['success'] = "Profile Updated Successfully";
            header("Location: ../profile.php");
            exit();
        } else {
            $_SESSION['error'] = "Profile Updation Failed";
            header("Location: ../edit_profile.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("Location: ../edit_profile.php");
    exit();
}
