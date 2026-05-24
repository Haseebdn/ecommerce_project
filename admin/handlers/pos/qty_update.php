<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST) && !empty($_POST)) {
        $qty = mysqli_real_escape_string($conn, $_POST['qty']);
        if(empty($qty)||($qty<0)){
            $qty=1;
        }
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $query = "UPDATE `pos_cart` SET `qty`='$qty' WHERE `id`='$id'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo json_encode(['status' => 200, 'msg' => 'Quantity Updated Successfully']);
        } else {
            echo json_encode(['status' => 500, 'msg' => 'Updation failed']);
        }
    }
} catch (mysqli_sql_exception $e) {

    echo $e->getMessage();
}
