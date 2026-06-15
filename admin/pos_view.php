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
                                 POS Table
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
                                             <th>Invoice NO.</th>
                                             <th>Customer Name</th>
                                             <th>Phone NO.</th>
                                             <th>Cashier Email</th>
                                             <th>Status</th>
                                             <th>Invoice</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `pos_user`";
                                            $oql = mysqli_query($conn, $query);
                                            while ($order = mysqli_fetch_assoc($oql)) {
                                            ?>
                                             <tr>
                                                 <td><?php echo $order['invoice_no'] ?></td>
                                                 <td><?php echo $order['name']    ?></td>
                                                 <td><?php echo $order['p_number']    ?></td>
                                                 <td><?php echo $order['adm_email']    ?></td>
                                                 <td>
                                                     <form id="status_form">
                                                         <select name="status" class="status" data-oid="<?php echo $order['invoice_no'] ?>">
                                                             <option value="pending" <?php echo (isset($order['status']) && $order['status'] == "pending") ? 'selected' : '' ?>>
                                                                 Pending
                                                             </option>
                                                             <option value="completed" <?php echo (isset($order['status']) && $order['status'] == "completed") ? 'selected' : '' ?>>
                                                                 Completed
                                                             </option>
                                                         </select>
                                                     </form>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./pos_invoice.php?iNo=<?php echo $order['invoice_no'] ?>">
                                                         <i class="fa-solid fa-receipt"></i>
                                                     </a>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-danger btn-sm deleteBtn"
                                                         href="./handlers/postable/delete.php?iNo=<?php echo base64_encode($order['invoice_no'])  ?>">
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
                 position: "center",
                 icon: "success",
                 title: "<?php echo $_SESSION['success']; ?>",
                 showConfirmButton: false,
                 timer: 2000
             });

             <?php unset($_SESSION['success']); ?>
         <?php } ?>

         <?php if (isset($_SESSION['error'])) { ?>
             Swal.fire({
                 position: "center",
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
                 url: "/admin/handlers/postable/status.php",
                 method: "POST",
                 data: {
                     value: select,
                     order_no: order_no
                 },
                 success: function(res) {
                     let response = JSON.parse(res);
                     if (response.status == 200) {
                         Swal.fire({
                             position: "center",
                             icon: "success",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                     } else {
                         Swal.fire({
                             position: "center",
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