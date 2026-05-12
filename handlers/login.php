<?php
include "../sql/conn.php";

if (isset($_POST)) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, $_POST['pass']);

    if (empty($email) || empty($pass)) {

        $_SESSION['error'] = "Please fill all fields";
        header("Location: ../login.php");
        exit();
    }

    try {

        $query = "SELECT `password`, `u_email`
                  FROM `user`
                  WHERE `u_email` = '$email'";

        $sql = mysqli_query($conn, $query);

        if (mysqli_num_rows($sql) == 1) {

            $User = mysqli_fetch_assoc($sql);

            $hashed_password = $User['password'];

            if (password_verify($pass, $hashed_password)) {

                $_SESSION['user_email'] = $User['u_email'];

                header("Location: ../index.php");
                exit();

            } else {

                $_SESSION['error'] = "Wrong password";

                header("Location: ../login.php");
                exit();
            }

        } else {

            $_SESSION['error'] = "Email not found";

            header("Location: ../login.php");
            exit();
        }

    } catch (mysqli_sql_exception) {

        $_SESSION['error'] = "Login failed";

        header("Location: ../login.php");
        exit();
    }
}
?>