<?php

use PHPMailer\PHPMailer\PHPMailer;

include "../sql/conn.php";
// print_r($_POST);
// die();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connected = @fsockopen("www.google.com", 80);

if ($connected) {

    fclose($connected);

    if (isset($_POST) && !empty($_POST)) {

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $otp = rand(100000, 999999);

        if (empty($email)) {

            $_SESSION['error'] = "Email Is Required";

            header("location:../forgot_otp.php");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION['error'] = "Invalid Email Format";

            header("location:../forgot_otp.php");
            exit();
        }

        try {

            $check_query = "SELECT `id`,`u_email`
                            FROM `user`
                            WHERE `u_email` = '$email'";

            $sql = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($sql) == 0) {

                $_SESSION['error'] = "Invalid Email";

                header("location:../forgot_otp.php");
                exit();
            }

            require "../php_mailer/PHPMailer.php";
            require "../php_mailer/Exception.php";
            require "../php_mailer/SMTP.php";

            $name = "MODRAZE";

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "haseebnazir437@gmail.com";
            $mail->Password = "imeccwhlgryfdwdl";
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

            $mail->isHTML(true);

            $mail->setFrom("haseebnazir437@gmail.com", $name);

            $mail->addAddress($email);

            $mail->Subject = "MODRAZE OTP";

            $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height:1.8;'>

                <h2>Your OTP Code is: $otp</h2>

                <p>
                    Please use this OTP code to reset your password.
                    <br>
                    Do not share this code with anyone.
                </p>

                <br>

                <p>
                    Regards,<br>
                    <strong>MODRAZE Team</strong>
                </p>

            </div>
            ";

            if ($mail->send()) {
                // echo 1;
                // die();
                $_SESSION['forgot_email'] = $email;
                $_SESSION['code'] = $otp;

                $_SESSION['success'] = "OTP Sent Successfully";
                header("location:../otp_pass.php");
                exit();
            } else {

                $_SESSION['error'] = "OTP Sending Failed";

                header("location:../forgot_otp.php");
                exit();
            }
        } catch (mysqli_sql_exception) {

            $_SESSION['error'] = "Database Error";

            header("location:../forgot_otp.php");
            exit();
        }
    }
} else {

    $_SESSION['error'] = "No Internet Connection";

    header("location:../forgot_otp.php");
    exit();
}
