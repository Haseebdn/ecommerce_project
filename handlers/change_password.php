<?php
include "../sql/conn.php";

if (isset($_POST)) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);

    if (empty($email) || empty($old_pass) || empty($new_pass)) {
        $_SESSION['error'] = "Please fill all fields correctly";
        header("Location: ../change_password.php");
        exit();
    }

    $query_pass = "SELECT `password` FROM `user` WHERE `u_email`='$email'";
    $pql = mysqli_query($conn, $query_pass);

    if (mysqli_num_rows($pql) > 0) {

        $fetch_pass = mysqli_fetch_assoc($pql);
        $f_pass = $fetch_pass['password'];

        if (password_verify($old_pass, $f_pass)) {

            $hashed = password_hash($new_pass, PASSWORD_BCRYPT);

            $update = "UPDATE `user`
                       SET `password`='$hashed'
                       WHERE `u_email`='$email'";

            $upl = mysqli_query($conn, $update);

            if ($upl) {

                $_SESSION['success'] = "Password updated successfully";

                session_unset();
                session_destroy();

                header("Location: ../login.php");
                exit();
            } else {

                $_SESSION['error'] = "Password update failed";
            }
        } else {

            $_SESSION['error'] = "Please enter correct old password";
        }
    } else {

        $_SESSION['error'] = "User not found";
    }

    header("Location: ../change_password.php");
    exit();
}
