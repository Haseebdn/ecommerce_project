<?php
require "../sql/conn.php";
$category = $_POST['category'];
$table = $_POST['table'];


$query = "UPDATE $table SET is_active = IF(is_active = 1, 0, 1) 
              WHERE cat_id = '$category'";


$sql = mysqli_query($conn, $query);


echo json_encode(["status" => 200, "message" => "$table updated successfully"], 200);
