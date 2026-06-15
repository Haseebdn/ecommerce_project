<?php
include "../../sql/conn.php";


try {

    if (isset($_GET['iNo']) && !empty($_GET['iNo'])) {

        $invoice_no = base64_decode($_GET['iNo']);

        if (empty($invoice_no)) {

            $_SESSION['error'] = "Invalid Order";

            header("location:../../pos_view.php");
            exit();
        }

        $query = "DELETE FROM `pos_orders`
                  WHERE `invoice_no`='$invoice_no'";

        $sql = mysqli_query($conn, $query);
        
        if ($sql) {
            $query = "DELETE FROM `pos_user`
                      WHERE `invoice_no`='$invoice_no'";
    
            $sql = mysqli_query($conn, $query);

            $_SESSION['success'] = "Order Successfully Deleted";

            header("location:../../pos_view.php");
            exit();
        } else {

            $_SESSION['error'] = "Deletion Failed";

            header("location:../../pos_view.php");
            exit();
        }
    }
} catch (mysqli_sql_exception $e) {

    $_SESSION['error'] = "Error :" . $e->getMessage();
    header("location:../../pos_view.php");
    exit();
}
