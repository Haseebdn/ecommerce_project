<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $email = $_SESSION['admin_email'];

    $output = "";
    $total_purchase = 0;

    if (isset($_POST) && !empty($_POST)) {

        $select = "SELECT * FROM `pos_cart`
                   WHERE `adm_email`='$email'";

        $sql = mysqli_query($conn, $select);

        while ($fetch = mysqli_fetch_assoc($sql)) {

            $total_purchase += $fetch['total_price'];

            $output .= "
            <tr> 
                <td class='py-2'>{$fetch['p_code']}</td>

                <td class='py-2'>{$fetch['p_name']}</td>

                <td class='py-2'>{$fetch['price']} PKR</td>

                <td class='py-2 col-2'>
                    <input type='number' 
                           class='form-control cart_qty'
                          data-qid='{$fetch['id']}' value='{$fetch['qty']}' min='1'>
                </td>

                <td class='py-2'>{$fetch['total_price']} PKR</td>

                <td class='py-2'>
                    <a class='btn btn-danger'
                       href='/admin/handlers/pos/delete_cart_item.php?id=" . base64_encode($fetch['id']) . "'>

                       <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>";
        }

        if ($sql) {

            echo json_encode([
                'status' => 200,
                'msg' => "Items Fetched",
                'data' => $output,
                'total_purchase' => $total_purchase
            ]);
        } else {

            echo json_encode([
                'status' => 500,
                'msg' => "Fetching Failed"
            ]);
        }
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        'status' => 500,
        'msg' => $e->getMessage()
    ]);
}
