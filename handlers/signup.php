<?php
include "../sql/conn.php";

if (isset($_POST) && !empty($_POST)) {
print_r($_POST);
print_r($_FILES);
die();

 $f_name=mysqli_real_escape_string($conn,$_POST['f_name']);
 $last_name=mysqli_real_escape_string($conn,$_POST['last_name']);
 $u_email=mysqli_real_escape_string($conn,$_POST['u_email']);
 $p_number=mysqli_real_escape_string($conn,$_POST['p_number']);
 $country=mysqli_real_escape_string($conn,$_POST['country']);
 $state=mysqli_real_escape_string($conn,$_POST['state']);
 $city=mysqli_real_escape_string($conn,$_POST['city']);
 $postal_code=mysqli_real_escape_string($conn,$_POST['postal_code']);
 $address=mysqli_real_escape_string($conn,$_POST['address']);
 $gender=mysqli_real_escape_string($conn,$_POST['gender']);
 $password=mysqli_real_escape_string($conn,$_POST['password']);
 $p_pic=$_FILES['p_pic']['name'];
}
