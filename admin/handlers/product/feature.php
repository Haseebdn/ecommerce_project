<?php
include "../../sql/conn.php";

try {
    if (isset($_POST)) {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $feature = $_POST['feature'];

        $query = "UPDATE $table SET `$feature`=IF(`$feature`=1,0,1) WHERE `id` ='$id' ";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            echo json_encode(["status" => 200, "message" => "$feature Updated Successfully"]);
        } else {
            echo json_encode(["status" => 500, "message" => mysqli_error($conn)]);
        }
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode([
        "status" => 500,
        "message" => $e->getMessage()
    ]);
}
