<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $email = $_SESSION['admin_email'];

    if (isset($_POST) && !empty($_POST)) {

        $id = intval($_POST['id']);

        $o_qty = intval($_POST['qty']);

        if (empty($id) || empty($o_qty)) {

            echo json_encode([
                'status' => 400,
                'msg' => "Invalid Product or Quantity"
            ]);

            exit();
        }

        $product = "SELECT * FROM `products`
                    WHERE `id` = '$id'";

        $pql = mysqli_query($conn, $product);

        $fetchP = mysqli_fetch_assoc($pql);

        if ($fetchP) {

            $p_id = $fetchP['id'];
            $p_name = $fetchP['p_name'];
            $p_code = $fetchP['p_code'];
            $sale_price = $fetchP['sale_price'];
            $stock = $fetchP['qty'];

            $checkCart = "SELECT * FROM `pos_cart`
                          WHERE `p_id` = '$p_id'
                          AND `adm_email` = '$email'";

            $checkRun = mysqli_query($conn, $checkCart);

            if (mysqli_num_rows($checkRun) > 0) {

                echo json_encode([
                    'status' => 409,
                    'msg' => "Product Already Exist In Cart"
                ]);

                exit();
            }

            if ($o_qty > $stock) {

                echo json_encode([
                    'status' => 400,
                    'msg' => "Insufficient Stock"
                ]);

                exit();
            }

            $t_price = $sale_price * $o_qty;

            $cart = "INSERT INTO `pos_cart`
                    (`p_id`,`p_name`,`price`,`p_code`,
                    `total_price`,`qty`,`adm_email`)
                    VALUES('$p_id','$p_name','$sale_price','$p_code','$t_price','$o_qty','$email')";

            $cql = mysqli_query($conn, $cart);

            if ($cql) {

                echo json_encode([
                    'status' => 200,
                    'msg' => "Successfully Added To Cart"
                ]);
            } else {

                echo json_encode([
                    'status' => 500,
                    'msg' => "Failed To Add To Cart"
                ]);
            }
        } else {

            echo json_encode([
                'status' => 404,
                'msg' => "Product Not Found"
            ]);
        }
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        'status' => 500,
        'msg' => $e->getMessage()
    ]);
}
