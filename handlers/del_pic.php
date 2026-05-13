<?php
include "../sql/conn.php";

$email = $_SESSION['user_email'];

$query = "SELECT p_pic FROM `user` WHERE `u_email`='$email'";
$sql = mysqli_query($conn, $query);
$fetch = mysqli_fetch_assoc($sql);
$f_pic = $fetch['p_pic'];

$query = "UPDATE `user` SET `p_pic`=NULL WHERE `u_email`='$email'";
$sql = mysqli_query($conn, $query);

if ($sql) {

    if (!empty($f_pic) && file_exists("../uploads/profile_pictures/$f_pic")) {
        unlink("../uploads/profile_pictures/$f_pic");
    }
    $_SESSION['success'] = "Picture Deleted Successfully";
    header("location:../profile.php");
    exit();
} else {
    $_SESSION['error'] = "Deletion Failed";
    header("location:../profile.php");
    exit();
}
