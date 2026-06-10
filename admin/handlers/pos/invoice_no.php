<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST) && !empty($_POST)) {

        $query = "SELECT `invoice_no`
                  FROM `pos_user`
                  ORDER BY `invoice_no` DESC
                  LIMIT 1";

        $sql = mysqli_query($conn, $query);

        $fetch = mysqli_fetch_assoc($sql);

        // if no invoice exists yet
        if ($fetch) {

            $invoice = intval($fetch['invoice_no']);

            $no = $invoice + 1;
        } else {

            $no = 1001; // starting invoice number

        }

        echo json_encode([
            'status' => 200,
            'msg' => "Invoice No Fetched Successfully",
            'data' => $no
        ]);
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        'status' => 500,
        'msg' => $e->getMessage()
    ]);
}
