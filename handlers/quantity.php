<?php
include "../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST['qty']) && isset($_POST['cart_id'])) {

        $qty = $_POST['qty'];

        $cart_id = $_POST['cart_id'];

        $price = "SELECT price FROM `cart` WHERE `id`='$cart_id' ";
        $wql = mysqli_query($conn, $price);
        $fetch = mysqli_fetch_assoc($wql);

        $price_p = $fetch['price'];
        $t_price = $price_p * $qty;

        $query = "UPDATE `cart` SET `qty`='$qty',`total_price`='$t_price'  WHERE `id`='$cart_id'";

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            echo json_encode([
                "status" => 200,
                "msg" => "Qty Updated"
            ]);
        } else {

            echo json_encode([
                "status" => 500,
                "msg" => "Failed To Update"
            ]);
        }
    }
} catch (mysqli_sql_exception) {
    echo json_encode([
        "status" => 500,
        "msg" => "Failed To Update"
    ]);
}
