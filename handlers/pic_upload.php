<?php
include "../sql/conn.php";

if (isset($_POST)) {
    $email = $_SESSION['user_email'];
    $p_pic = $_FILES['p_pic']['name'];
    $p_tmp = $_FILES['p_pic']['tmp_name'];

    if (!empty($p_pic)) {
        $query = "SELECT p_pic FROM `user` WHERE `u_email`='$email'";
        $sql = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($sql);
        $f_pic = $fetch['p_pic'];

        if (file_exists("../uploads/profile_pictures/$f_pic")) {
            unlink("../uploads/profile_pictures/$f_pic");
        }
    } else {
        $_SESSION['error'] = "Updation Failed ";
        header("location:../profile.php");
        exit();
    }

    $pic_name = '';
    if (!empty($p_pic)) {
        $ext = strtolower(pathinfo($p_pic, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $_SESSION['error'] = "Invalid File Format";
            header("location:../profile.php");
            exit();
        }
        $pic_name = time() . rand(1, 10000) . '.' . $ext;
        move_uploaded_file($p_tmp, '../uploads/profile_pictures/' . $pic_name);
    }

    $query = "UPDATE `user` SET `p_pic`='$pic_name' WHERE `u_email`='$email'";

    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Picture Updated Successfully";
        } else {
            $_SESSION['error'] = "Updation Failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Updation Failed";
    }

    header("location:../profile.php");
    exit();
}
