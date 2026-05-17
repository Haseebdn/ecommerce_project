 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <!-- alert -->
             <?php if (isset($_SESSION['success'])) { ?>
                 <div class="alert text-center alert-success">
                     <?php echo $_SESSION['success']; ?>
                 </div>
             <?php unset($_SESSION['success']);
                } ?>

             <?php if (isset($_SESSION['error'])) { ?>
                 <div class="alert text-center alert-danger">
                     <?php echo $_SESSION['error']; ?>
                 </div>
             <?php unset($_SESSION['error']);
                } ?>
             <!-- alert -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header d-flex justify-content-between">
                             <h4>Orders Table</h4>
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
                                                 <td><?php echo $order['p_name']    ?></td>
                                                 <td><?php echo $order['p_code']    ?></td>
                                                 <td><?php echo $order['t_price']    ?></td>
                                                 <td><?php echo $order['p_qty']    ?></td>
                                                 <td><?php echo $order['order_no']    ?></td>
                                                 <td><?php echo $order['order_email']    ?></td>
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./invoice.php?oNo=<?php echo $order ['order_no'] ?>"><i class="fa-solid fa-receipt"></i></a>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-danger btn-sm" href="./handlers/order/delete.php"><i class="fa-solid fa-trash"></i></a>
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


 <?php
    include "./include/footer.php";
    ?>
 <script src="assets/bundles/datatables/datatables.min.js"></script>

 <script src="assets/js/page/datatables.js"></script>