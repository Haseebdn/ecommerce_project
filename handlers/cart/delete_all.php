<?php
include "../../sql/conn.php";

$email = $_SESSION['user_email'];

$query = "DELETE FROM `cart` where `u_email`='$email'";
$sql = mysqli_query($conn, $query);

header("location:../../shopping_cart.php");
exit();
