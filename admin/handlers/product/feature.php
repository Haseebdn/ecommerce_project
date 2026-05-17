<?php
include "../../sql/conn.php";

if (isset($_POST)) {
    $id = $_POST['id'];
    $table = $_POST['table'];
    $feature = $_POST['feature'];

    $query = "UPDATE $table SET `$feature`=IF(`$feature`=1,0,1) WHERE `id` ='$id' ";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        echo json_encode(["status" => 200, "message" => "$feature updated successfully"]);
    } else {
        echo json_encode(["status" => 500, "message" => mysqli_error($conn)]);
    }
}
