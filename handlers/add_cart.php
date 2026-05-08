<?php  
include "../sql/conn.php";
$email=$_SESSION['email'];
if (isset($_POST)&& !empty($_POST)){
    $p_id=$_POST['id'];

    $fetch_p= "SELECT p_name,p_thumbnail,p_code,sale_price `products` WHERE `id`=$p_id";
    $sql=mysqli_query($conn,$fetch_p);
    $row=mysqli_fetch_assoc($sql);

    $p_name=$row['p_name'];
    $p_thumbnail=$row['p_thumbnail'];
    $p_code=$row['p_code'];
    $sale_price=$row['sale_price'];

    $query="INSERT INTO `cart` (`p_id`,`p_name`,`price`,`p_code`,`p_thumbnail`,`total_price`,`u_email`) VALUES('$p_id','$p_name','$sale_price','$p_code','$p_thumbnail','$sale_price','$email')";
    $sql=mysqli_query($conn,$query);

}
?>