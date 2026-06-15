<?php
include "../../sql/conn.php";


try {

    if (isset($_POST) && !empty($_POST)) {
        $qty = mysqli_real_escape_string($conn, $_POST['qty']);
        if(empty($qty)||($qty<0)){
            $qty=1;
        }
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $price="SELECT `price` FROM `pos_cart`WHERE `id`=$id";
        $pql=mysqli_query($conn,$price);
        $fetch=mysqli_fetch_assoc($pql);
        $p_price=$fetch['price'];
        $t_price=$qty * $p_price;

        $query = "UPDATE `pos_cart` SET `qty`='$qty', `total_price`='$t_price' WHERE `id`='$id'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo json_encode(['status' => 200, 'msg' => 'Quantity Updated Successfully']);
        } else {
            echo json_encode(['status' => 500, 'msg' => 'Updation Failed']);
        }
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        'status' => 500,
        'msg' => $e->getMessage()
    ]);
}
