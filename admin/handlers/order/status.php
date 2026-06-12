 <?php
   include "../../sql/conn.php";

   try {
      if (isset($_POST)) {
         $order_no = $_POST['order_no'];
         $status = $_POST['value'];

         $query = "UPDATE `orders`
                              Set `status`='$status'
                              WHERE `order_no`='$order_no' ";

         $sql = mysqli_query($conn, $query);

         if ($sql) {
            echo json_encode([
               "status" => 200,
               "msg" => "Status Updated Successfully"
            ]);
         }
      }
   } catch (mysqli_sql_exception $e) {
      echo json_encode([
         "status" => 500,
         "msg" => $e->getmessage(),
      ]);
   }
