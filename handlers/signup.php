<?php
include "../sql/conn.php";

if (isset($_POST) && !empty($_POST)) {


    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $u_email = mysqli_real_escape_string($conn, $_POST['u_email']);
    $p_number = mysqli_real_escape_string($conn, $_POST['p_number']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $p_pic = $_FILES['p_pic']['name'];
    $p_tmp = $_FILES['p_pic']['tmp_name'];

    if (empty($f_name) || empty($last_name) || empty($u_email) || empty($p_number) || empty($country) || empty($state) || empty($city) || empty($postal_code) || empty($address) || empty($gender) || empty($password)) {
        $_SESSION['error'] = "Please Fill All Fields Correctly";
        header("location:../signup.php");
        exit();
    }

    $pic_name = '';
    if (!empty($p_pic)) {
        $ext = strtolower(pathinfo($p_pic, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $_SESSION['error'] = "Invalid File Format";
            header("location:../signup.php");
            exit();
        }
        $pic_name = time() . rand(1, 10000) . '.' . $ext;
        move_uploaded_file($p_tmp, '../uploads/profile_pictures/' . $pic_name);
    }

    $check_email = "SELECT `u_email`
                FROM `user`
                WHERE `u_email`='$u_email'";

    $check_run = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($check_run) > 0) {

        $_SESSION['error'] = "Email already exists";

        header("Location: ../signup.php");
        exit();
    }

    $query = "INSERT INTO `user` (`f_name`,`last_name`,`u_email`,`p_number`,`country`,`state`,`city`,`postal_code`,`address`,`gender`,`password`,`p_pic`) VALUES('$f_name','$last_name','$u_email','$p_number','$country','$state','$city','$postal_code','$address','$gender','$hashed','$pic_name')";

    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Data Insertion failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Insertion failed";
    }

    header("location:../login.php");
    exit();
}
