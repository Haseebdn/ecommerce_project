<?php
include "../sql/conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

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

                $check = mysqli_query(
                    $conn,
                    "SELECT id FROM user WHERE u_email='$new_email'"
                );

                if (mysqli_num_rows($check) > 0) {
                    $_SESSION['error'] = "Email already exists";
                    header("Location: ../change_email.php");
                    exit();
                }

                $update = "UPDATE `user` 
                       SET `u_email` = '$new_email' 
                       WHERE `u_email` = '$u_email'";

                mysqli_begin_transaction($conn);

                $run = mysqli_query($conn, $update);
                if ($run) {
                    $query = "UPDATE `cart` SET `u_email`='$new_email' WHERE  `u_email`='$u_email'";
                    $sql = mysqli_query($conn, $query);

                    if (!$sql) {
                        throw new Exception("Cart updation failed");
                    }

                    mysqli_commit($conn);

                    $_SESSION['success'] = "Email updated successfully";
                    unset($_SESSION['user_email']);

                    header("Location: ../login.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Email updation failed";
                }
            } else {
                $_SESSION['error'] = "Incorrect password";
            }
        } else {
            $_SESSION['error'] = "Invalid old email";
        }
        header("Location: ../change_email.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($conn);
    $_SESSION['error'] = "Error:" . $e->getMessage();
    header("Location: ../change_email.php");
    exit();
}
