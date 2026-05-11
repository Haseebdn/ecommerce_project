<?php
include "../../sql/conn.php";
if (isset($_GET)) {
    $id = $_GET['remove'];

    $query = "DELETE FROM `cart` where `id`=$id";
    $sql = mysqli_query($conn, $query);
    header("location:../../shopping_cart.php");
    exit();
}
