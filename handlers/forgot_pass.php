<?php
include "../sql/conn.php";

$fEmail = @$_SESSION['forgot_email'];
$code = @$_SESSION['code'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST) && !empty($_POST)) {

        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $new_pass = mysqli_real_escape_string($conn, trim($_POST['new_pass']));
        $otp = mysqli_real_escape_string($conn, trim($_POST['otp']));

        $hashed = password_hash($new_pass, PASSWORD_BCRYPT);

        // Empty validation
        if (empty($email) || empty($new_pass) || empty($otp)) {

            $_SESSION['error'] = "Please Fill  All Fields Correctly";

            header("location:../otp_pass.php");
            exit();
        }

        // OTP validation
        if ($email == $fEmail && $otp == $code) {

            $query = "UPDATE `users`
                      SET `password` = '$hashed'
                      WHERE `u_email` = '$email'";

            $sql = mysqli_query($conn, $query);

            if ($sql) {

                unset($_SESSION['code']);
                unset($_SESSION['forgot_email']);

                $_SESSION['success'] = "Password Updated Successfully";

                header("location:../login.php");
                exit();

            } else {

                $_SESSION['error'] = "Password Updation Failed";

                header("location:../otp_pass.php");
                exit();
            }

        } else {

            $_SESSION['error'] = "Invalid OTP Or Email";

            header("location:../otp_pass.php");
            exit();
        }
    }

} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error:". $e->getMessage();

    header("location:../otp_pass.php");
    exit();
}
?>