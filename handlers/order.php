<?php

use PHPMailer\PHPMailer\PHPMailer;

include "../sql/conn.php";

try {

    $connected = @fsockopen("www.google.com", 80);

    if ($connected) {

        fclose($connected);

        if (isset($_POST)) {

            $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $u_email = mysqli_real_escape_string($conn, $_POST['u_email']);
            $p_number = mysqli_real_escape_string($conn, $_POST['p_number']);
            $country = mysqli_real_escape_string($conn, $_POST['country']);
            $state = mysqli_real_escape_string($conn, $_POST['state']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $order_no = rand(100000, 999999);
            $payment_method = mysqli_real_escape_string($conn, $_POST['payment']);

            $g_total = 0;

            if (
                empty($f_name) || empty($last_name) || empty($u_email) ||
                empty($p_number) || empty($country) || empty($state) ||
                empty($city) || empty($postal_code) || empty($address) ||
                empty($gender)
            ) {

                $_SESSION['error'] = "Please Fill All Fields Correctly";
                header("location:../checkout_form.php");
                exit();
            }

            $query = "INSERT INTO `order_user`
        (`f_name`,`last_name`,`od_email`,`od_phone`,`od_country`,
        `od_state`,`od_city`,`od_postal`,`od_address`,
        `od_gender`,`order_no`,`payment_method`)
        
        VALUES(
        '$f_name',
        '$last_name',
        '$u_email',
        '$p_number',
        '$country',
        '$state',
        '$city',
        '$postal_code',
        '$address',
        '$gender',
        '$order_no',
        '$payment_method'
        )";

            $sql = mysqli_query($conn, $query);

            if ($sql) {

                $cart_query = "SELECT * FROM `cart` WHERE `u_email`='$u_email'";
                $cart = mysqli_query($conn, $cart_query);

                $place_order = true;

                while ($product = mysqli_fetch_assoc($cart)) {
                    $price = $product['price'];
                    $p_id = $product['p_id'];
                    $p_name = $product['p_name'];
                    $total_price = $product['total_price'];
                    $p_code = $product['p_code'];
                    $qty = $product['qty'];

                    $g_total += $total_price;

                    $order = "INSERT INTO `orders`
                (`p_id`,`p_name`,`price`,`t_price`,`p_code`,`p_qty`,`order_no`,`order_email`)
                
                VALUES(
                '$p_id',
                '$p_name',
                '$price',
                '$total_price',
                '$p_code',
                '$qty',
                '$order_no',
                '$u_email'
                )";

                    $place_order = mysqli_query($conn, $order);

                    if (!$place_order) {
                        break;
                    }
                }

                if ($place_order) {

                    require "../php_mailer/PHPMailer.php";
                    require "../php_mailer/Exception.php";
                    require "../php_mailer/SMTP.php";

                    $name = "MODRAZE";

                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "haseebnazir437@gmail.com";
                    $mail->Password = "imeccwhlgryfdwdl";
                    $mail->Port = 465;
                    $mail->SMTPSecure = "ssl";

                    $mail->isHTML(true);

                    $mail->setFrom("haseebnazir437@gmail.com", $name);

                    $mail->addAddress($u_email);

                    $mail->Subject = "MODRAZE Invoice ID";

                    $mail->Body = "
                <h1>Your invoice ID is $order_no</h1>

                <p>
                You have made a purchase of total RS. $g_total PKR.
                Please use this invoice id to confirm your order when you receive your parcel from our courier service partner.
                <br><br>
                Thanks for shopping!
                </p>
                ";

                    if ($mail->send()) {

                        $dsql = "DELETE FROM `cart` WHERE `u_email`='$u_email'";
                        $drun = mysqli_query($conn, $dsql);

                        if ($drun) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 3;
                    }
                }
            }
        }

        echo json_encode([
            "status" => 200,
            "msg" => "Order Placed Successfully"
        ]);
    } else {
        echo json_encode([
            "status" => 500,
            "message" => "Order Failed"
        ]);
    }
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
}
