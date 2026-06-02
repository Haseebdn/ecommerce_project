<?php
include "../../sql/conn.php";

$response = [
    'cart_count' => 0,
    'grand_total' => 0
];

if (isset($_SESSION['user_email'])) {

    $email = $_SESSION['user_email'];

    $query = "SELECT
                COUNT(id) AS total_items,
                COALESCE(SUM(total_price),0) AS total_price
              FROM cart
              WHERE u_email='$email'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);

        $response['cart_count'] = (int)$data['total_items'];
        $response['grand_total'] = (float)$data['total_price'];
    }
}

header('Content-Type: application/json');
echo json_encode($response);