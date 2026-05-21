<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// print_r($_POST);
// die();
try {

    $email = $_SESSION['admin_email'];
    if (isset($_POST) && !empty($_POST)) {
        $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $p_number = mysqli_real_escape_string($conn, $_POST['p_number']);
        $t_price = mysqli_real_escape_string($conn, $_POST['t_price']);
        $pay_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

        if (empty($invoice_no) || empty($name) || empty($p_number) || empty($t_price) || empty($pay_status)) {
            echo json_encode(['status' => 500, "msg", "Please fill all fields correctly"]);
            exit();
        }

        $query = "INSERT INTO `order_user` (`name`,`p_number`,`t_purchase`,`invoice_no`,`adm_email`,`status`) VALUES('$name','$p_number','$t_price','$invoice_no','$pay_status')";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo json_encode(['status' => 200, 'msg' => "Data inserted successfully"]);
        } else {
            echo json_encode(['status' => 500, 'msg' => "Data insertion failed"]);
        }
    }
} catch (mysqli_sql_exception) {
    echo json_encode(['status' => 500, 'msg' => "Data insertion failed"]);
}
