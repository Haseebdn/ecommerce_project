<?php
include "../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_POST)) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass  = mysqli_real_escape_string($conn, $_POST['pass']);

        if (empty($email) || empty($pass)) {

            $_SESSION['error'] = "Please Fill All Fields Correctly";
            header("Location: ../login.php");
            exit();
        }


        $query = "SELECT `password`, `u_email`
                  FROM `user`
                  WHERE `u_email` = '$email'";

        $sql = mysqli_query($conn, $query);

        if (mysqli_num_rows($sql) == 1) {

            $User = mysqli_fetch_assoc($sql);

            $hashed_password = $User['password'];

            if (password_verify($pass, $hashed_password)) {

                $_SESSION['user_email'] = $User['u_email'];
                $_SESSION['success'] = "Logged In Successfully";
                header("Location: ../index.php");
                exit();
            } else {

                $_SESSION['error'] = "Wrong Password";

                header("Location: ../login.php");
                exit();
            }
        } else {

            $_SESSION['error'] = "Invalid Email";

            header("Location: ../login.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("Location: ../login.php");
    exit();
}
