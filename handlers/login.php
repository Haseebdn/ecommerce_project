<?php
include "../sql/conn.php";

if (!empty($_POST['email'])) {

    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    try {

        $query = "SELECT `password`, `u_email`
                  FROM `user`
                  WHERE `u_email` = '$email'";

        $sql = mysqli_query($conn, $query);

        if (mysqli_num_rows($sql) == 1) {

            $User = mysqli_fetch_assoc($sql);

            if ($pass == $User['password']) {

                $_SESSION['user_email'] = $User['u_email'];

                header("location:../index.php");
                exit();

            } else {

                $_SESSION['error'] = "Wrong password";

                header("location:../login.php");
                exit();
            }

        } else {

            $_SESSION['error'] = "Email not found";

            header("location:../login.php");
            exit();
        }

    } catch (mysqli_sql_exception $e) {

        $_SESSION['error'] = "Login failed";

        header("location:../login.php");
        exit();
    }
}
?>