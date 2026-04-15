<?php
include "../../sql/conn.php";

if (isset($_POST) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT id,cat_name FROM `categories` WHERE `parent_id`=$id";
    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_all($sql,MYSQLI_ASSOC);

    echo json_encode(["status" => 200, "message" => "Data fetched successfully", "data" => $row], 200);
}
