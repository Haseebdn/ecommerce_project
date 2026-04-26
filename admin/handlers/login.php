<?php
include "../sql/conn.php";

if (isset($_POST) && !empty($_POST)) {

    $adm_email = mysqli_real_escape_string($conn, $_POST['adm_email']);
    $adm_pass  = mysqli_real_escape_string($conn, $_POST['adm_pass']);

    // validation
    if (empty($adm_email) || empty($adm_pass)) {
        $_SESSION['error'] = "Please Fill All Fields Correctly";
        header("location: /admin/index.php");
        exit();
    }
    // validation

    try {
        // query
        $query = "SELECT * FROM `admin` WHERE adm_email='$adm_email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        // query

        if (mysqli_num_rows($result) == 1) {

            $admin = mysqli_fetch_assoc($result);

            if ($adm_pass == $admin['adm_pass']) {
                if (!$admin['is_active'] == 1) {
                    $_SESSION['error'] = "Your access blocked";
                    header("Location: /admin/home.php");
                    exit();
                } else {

                    $_SESSION['role_id'] = $admin['adm_role'];
                    $_SESSION['admin_email'] = $admin['adm_email'];

                    header("Location: /admin/home.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Wrong password";
            }
        } else {
            $_SESSION['error'] = "Email not found";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Login failed";
    }

    header("location: /admin/index.php");
    exit();
}
