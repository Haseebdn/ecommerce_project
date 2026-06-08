<?php
include "../sql/conn.php";
// print_r($_POST);
// die();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_POST)) {
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['u_email']);
        $msg = mysqli_real_escape_string($conn, $_POST['msg']);

        if (empty($last_name) || empty($email) || empty($msg)) {
            $_SESSION['error'] = "Please Fill In All Fields Correctly";
            header('location:../contact.php');
            exit();
        }

        $query = "INSERT INTO `contact_mails` (`name`,`u_email`,`msg`) VALUES ('$last_name','$email','$msg')";

        $sql = mysqli_query($conn, $query);
        if ($sql) {
            $_SESSION['success'] = "Message Sent Successfully";
            header("location:../contact.php");
            exit();
        } else {
            $_SESSION['error'] = "Message Sending Failed";
            header("location:../contact.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../contact.php");
    exit();
}
