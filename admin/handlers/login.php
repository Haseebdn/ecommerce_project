
    // include "../sql/conn.php";

    // // print_r($_POST);
    // // die();
    // try {

    //     if (isset($_POST) && !empty($_POST)) {

    //         $adm_email = mysqli_real_escape_string($conn, $_POST['adm_email']);
    //         $adm_pass  = mysqli_real_escape_string($conn, $_POST['adm_pass']);

    //         if (empty($adm_email) || empty($adm_pass)) {
    //             $_SESSION['error'] = "Please Enter Valid Credits";
    //             header("location:../index.php");
    //         }

    //         // Query
    //         $query = "SELECT * FROM admin WHERE email='$adm_email' LIMIT 1";
    //         $result = mysqli_query($conn, $query);

    //         if (mysqli_num_rows($result) == 1) {

    //             $admin = mysqli_fetch_assoc($result);

    //             if ($adm_pass == $admin['adm_pass']) {

    //                 $_SESSION['admin_id'] = $admin['id'];
    //                 $_SESSION['admin_email'] = $admin['email'];

    //                 header("Location: ../dashboard.php");
    //                 exit();
    //             } else {
    //                 throw new Exception("Wrong password");
    //             }
    //         } else {
    //             throw new Exception("Email not found");
    //         }
    //     }
    // } catch (mysqli_sql_exception) {

    //     $_SESSION['error'] = "Please Enter Valid Credits";
    //     header("Location: ../index.php");
    //     exit();
    // }
 


<?php
include "../sql/conn.php";

// Enable mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST) && !empty($_POST)) {

        $adm_email = mysqli_real_escape_string($conn, $_POST['adm_email']);
        $adm_pass  = mysqli_real_escape_string($conn, $_POST['adm_pass']);

        if (empty($adm_email) || empty($adm_pass)) {
            throw new Exception("Please Enter Valid Credentials");
        }

        $query = "SELECT * FROM admin WHERE adm_email='$adm_email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $admin = mysqli_fetch_assoc($result);

            if ($adm_pass == $admin['adm_pass']) {

                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_email'] = $admin['adm_email'];

                header("Location: ../index.php");
                exit();
            } else {
                throw new Exception("Wrong password");
            }
        } else {
            throw new Exception("Email not found");
        }
    }
} catch (Throwable $e) {

    $_SESSION['error'] = $e->getMessage();
    header("location: ../index.php");
    exit();
}
?>