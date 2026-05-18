 <?php
   include "../../sql/conn.php";
   // print_r($_POST);
   // die();
   if (isset($_POST)) {
      $order_no = $_POST['order_no'];
      $status = $_POST['value'];

      $query = "UPDATE `orders`
                              Set `status`='$status'
                              WHERE `order_no`='$order_no' ";
                              
      try {
         $sql = mysqli_query($conn, $query);

         if ($sql) {
            echo json_encode([
               "status" => 200,
               "msg" => "Status Updated Successfully"
            ]);
         } else {
            echo json_encode([
               "status" => 500,
               "msg" => "Status Updation Failed"
            ]);
         }
      } catch (mysqli_sql_exception) {
         echo json_encode([
            "status" => 500,
            "msg" => "Status Updation Failed"
         ]);
      }
   }
