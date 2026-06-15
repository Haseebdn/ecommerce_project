<?php
include "../../sql/conn.php";


try {

    $email = $_SESSION['admin_email'];

    if (isset($_POST) && !empty($_POST)) {

        $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $p_number = mysqli_real_escape_string($conn, $_POST['p_number']);
        $t_price = mysqli_real_escape_string($conn, $_POST['t_price']);
        $pay_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

        if (
            empty($invoice_no) ||
            empty($name) ||
            empty($p_number) ||
            empty($t_price) ||
            empty($pay_status)
        ) {

            echo json_encode([
                'status' => 500,
                'msg' => "Please Fill All Fields Correctly"
            ]);
            exit();
        }

        $query = "INSERT INTO `pos_user`
        (`name`,`p_number`,`t_purchase`,`invoice_no`,`adm_email`,`status`) VALUES
        ('$name','$p_number','$t_price','$invoice_no','$email','$pay_status')";
        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $select = "SELECT * FROM `pos_cart` WHERE `adm_email`='$email'";
            $fql = mysqli_query($conn, $select);

            $iql = true;

            while ($fetch = mysqli_fetch_assoc($fql)) {

                $p_name = $fetch['p_name'];
                $price = $fetch['price'];
                $p_code = $fetch['p_code'];
                $total_price = $fetch['total_price'];
                $p_qty = $fetch['qty'];
                $adm_email = $fetch['adm_email'];

                $insert = "INSERT INTO `pos_orders`
                (`p_name`,`p_code`,`p_qty`,`p_price`,`total_price`,`invoice_no`,`adm_email`,`status`) VALUES
                ('$p_name','$p_code','$p_qty','$price','$total_price','$invoice_no','$adm_email','$pay_status')";

                $iql = mysqli_query($conn, $insert);
            }

            if ($iql) {

                $delete = "DELETE FROM `pos_cart` WHERE `adm_email`='$email'";
                $dql = mysqli_query($conn, $delete);
                echo json_encode([
                    'status' => 200,
                    'msg' => "Order Placed Successfully"
                ]);
            } else {

                echo json_encode([
                    'status' => 500,
                    'msg' => "Failed To Place Order"
                ]);
            }
        } else {

            echo json_encode([
                'status' => 500,
                'msg' => "Failed To Place Order"
            ]);
        }
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        'status' => 500,
        'msg' => $e->getMessage()
    ]);
}
