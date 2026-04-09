<?php
include "../assets/sql/conn.php";


$action = $_GET['action'];

if ($action == "fetchCategory") {
    $query = "SELECT * From `categories`";
    $sql = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($sql,MYSQLI_ASSOC);

    echo json_encode(["status" => 200, "message" => "Category Fetched Successfully", "data" => $data], 200);
}
