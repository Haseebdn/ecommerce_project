<?php

use PHPMailer\PHPMailer\PHPMailer;

include "../../sql/conn.php";

$connected = @fsockopen("www.google.com", 80);

if (isset($_POST)) {

    $u_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['u_email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    if (empty($u_name) || empty($email) || empty($subject) || empty($msg)) {
        $_SESSION['error'] = "Please fill in all fields correctly";
        header("location:../../reply_form.php");
        exit();
    }

    if ($connected) {

        fclose($connected);


        require "../../php_mailer/PHPMailer.php";
        require "../../php_mailer/Exception.php";
        require "../../php_mailer/SMTP.php";

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

        $mail->Subject = "$subject";

        $mail->Body = "Dear Mr./Mrs.<br><span style='padding-left:80px;'>$u_name,</span>
                                       
                        $msg <br>
                        Thanks! For your attention to this matter. 
                        </p>
    ";

        if ($mail->send()) {
            $_SESSION['success'] = "Email Sent Successfully";
        } else {
            $_SESSION['error'] = "Email Sending Failed";
        }
        header("location:../../reply_form.php");
        exit();
    } else {
        $_SESSION['error'] = "Internet Connection Failed";
        header("location:../../reply_form.php");
        exit();
    }
}
