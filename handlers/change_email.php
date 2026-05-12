<?php
include "../sql/conn.php";

if (isset($_POST)) {

    $u_email   = mysqli_real_escape_string($conn, $_POST['old_email']);
    $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
    $password  = mysqli_real_escape_string($conn, $_POST['pass']);

    if (empty($u_email) || empty($new_email) || empty($password)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header("Location: ../change_email.php");
        exit();
    }

    $query = "SELECT `password` FROM `user` WHERE `u_email` = '$u_email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $fetch = mysqli_fetch_assoc($result);
        $hashed_pass = $fetch['password'];

        if (password_verify($password, $hashed_pass)) {

            $update = "UPDATE `user` 
                       SET `u_email` = '$new_email' 
                       WHERE `u_email` = '$u_email'";

            $run = mysqli_query($conn, $update);

            if ($run) {
                $query = "UPDATE `cart` SET `u_email`='$new_email' WHERE  `u_email`='$u_email'";
                $sql = mysqli_query($conn, $query);
                $_SESSION['success'] = "Email updated successfully";
            } else {
                $_SESSION['error'] = "Email update failed";
            }
        } else {
            $_SESSION['error'] = "Incorrect password";
        }
    } else {
        $_SESSION['error'] = "Old email not found";
    }

    session_unset();

    // destroy the session
    session_destroy();

    // redirect user
    header("Location: ../login.php");
    exit();
}
