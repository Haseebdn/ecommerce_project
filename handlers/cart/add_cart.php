<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $email = $_SESSION['user_email'];

    if (!empty($_POST['id'])) {

        $p_id = intval($_POST['id']);

        $checkQuery = "SELECT * FROM `cart`
                       WHERE `p_id`='$p_id'
                       AND `u_email`='$email'";

        $checkRun = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkRun) > 0) {

            echo json_encode([
                "status" => 409,
                "message" => "Product Already Added To Cart"
            ]);

            exit();
        }

        $fetch_p = "SELECT p_name,p_thumbnail,p_code,sale_price
                    FROM `products`
                    WHERE `id`='$p_id'";

        $sql = mysqli_query($conn, $fetch_p);

        if (mysqli_num_rows($sql) > 0) {

            $row = mysqli_fetch_assoc($sql);

            $p_name = $row['p_name'];
            $p_thumbnail = $row['p_thumbnail'];
            $p_code = $row['p_code'];
            $sale_price = $row['sale_price'];

            $query = "INSERT INTO `cart`
            (`p_id`,`p_name`,`price`,`p_code`,
            `p_thumbnail`,`total_price`,`u_email`)
            
            VALUES
            
            ('$p_id','$p_name','$sale_price',
            '$p_code','$p_thumbnail',
            '$sale_price','$email')";

            if (mysqli_query($conn, $query)) {

                echo json_encode([
                    "status" => 200,
                    "message" => "Added To Cart"
                ]);
            } else {

                echo json_encode([
                    "status" => 500,
                    "message" => "Failed To Add To Cart"
                ]);
            }
        } else {

            echo json_encode([
                "status" => 404,
                "message" => "Product Not Found"
            ]);
        }
    }
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
}
