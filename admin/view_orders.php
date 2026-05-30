 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header d-flex justify-content-between">
                             <h4>
                                 Orders Table
                             </h4>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->
                                     <thead>
                                         <tr>
                                             <th>Product</th>
                                             <th>Product Code</th>
                                             <th>Total Price</th>
                                             <th>Quantity</th>
                                             <th>Order No.</th>
                                             <th>Email</th>
                                             <th>Status</th>
                                             <th>Invoice</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `orders`";
                                            $sql = mysqli_query($conn, $query);
                                            while ($order = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td>
                                                     <?php echo $order['p_name']    ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $order['p_code']    ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $order['t_price']    ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $order['p_qty']    ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $order['order_no']    ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $order['order_email']    ?>
                                                 </td>

                                                 <td>
                                                     <form id="status_form">
                                                         <select name="status" class="status" data-oid="<?php echo $order['order_no']; ?>">
                                                             <option value=" <?php echo $order['status'] ?>" <?php echo (isset($order['status']) && $order['status'] == "pending") ? 'selected' : '' ?>>
                                                                 Pending
                                                             </option>
                                                             <option value="completed" <?php echo (isset($order['status']) && $order['status'] == "completed") ? 'selected' : '' ?>>
                                                                 Completed
                                                             </option>
                                                         </select>
                                                     </form>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./invoice.php?oNo=<?php echo $order['order_no'] ?>">
                                                         <i class="fa-solid fa-receipt"></i>
                                                     </a>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-danger btn-sm deleteBtn"
                                                         href="./handlers/order/delete.php?id=<?php echo base64_encode($order['id']) ?>">
                                                         <i class="fa-solid fa-trash"></i>
                                                     </a>
                                                 </td>
                                             </tr>
                                         <?php
                                            }
                                            ?>

                                     </tbody>
                                     <!-- table body -->
                                 </table>
                                 <!-- table -->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>


 <?php include "./include/footer.php"; ?>

 <script src="assets/bundles/datatables/datatables.min.js"></script>
 <script src="assets/js/page/datatables.js"></script>

 <script>
     $(document).ready(function() {

         <?php if (isset($_SESSION['success'])) { ?>
             Swal.fire({
                 position: "top-end",
                 icon: "success",
                 title: "<?php echo $_SESSION['success']; ?>",
                 showConfirmButton: false,
                 timer: 2000
             });

             <?php unset($_SESSION['success']); ?>
         <?php } ?>

         <?php if (isset($_SESSION['error'])) { ?>
             Swal.fire({
                 position: "top-end",
                 icon: "error",
                 title: "<?php echo $_SESSION['error']; ?>",
                 showConfirmButton: false,
                 timer: 2000
             });
             <?php unset($_SESSION['error']); ?>
         <?php } ?>

         $(document).on('change', '.status', function() {
             let order_no = $(this).data('oid');
             let select = $(this).val();

             $.ajax({
                 url: "/admin/handlers/order/status.php",
                 method: "POST",
                 data: {
                     value: select,
                     order_no: order_no
                 },
                 success: function(res) {
                     let response = JSON.parse(res);
                     if (response.status == 200) {
                         Swal.fire({
                             position: "top-end",
                             icon: "success",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                     } else {
                         Swal.fire({
                             position: "top-end",
                             icon: "error",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                     }
                 }
             });
         });

         $(document).on('click', '.deleteBtn', function(e) {
             e.preventDefault();
             let link = $(this).attr('href');

             Swal.fire({
                 title: "Are you sure?",
                 text: "This order will be deleted permanently!",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#d33",
                 cancelButtonColor: "#3085d6",
                 confirmButtonText: "Yes, delete it!"
             }).then((result) => {
                 if (result.isConfirmed) {
                     window.location.href = link;
                 }
             });
         });

     });
 </script>