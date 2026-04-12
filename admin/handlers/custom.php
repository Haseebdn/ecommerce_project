<?php
require "../sql/conn.php";
if (isset($_POST) && !empty($_POST)) {
    // variables
    $category = $_POST['category'];
    $table = $_POST['table'];
    // variables

    // query
    $query = "UPDATE $table SET is_active = IF(is_active = 1, 0, 1) 
                  WHERE cat_id = '$category'";

    $sql = mysqli_query($conn, $query);
    // query

    // response
    echo json_encode(["status" => 200, "message" => "$table updated successfully"], 200);
    // response
}
