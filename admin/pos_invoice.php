 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    if (isset($_GET)) {
        $invoice_no = $_GET['iNo'];
    }
    // else{
    //     $_SESSION['error']="Invalid Order";
    //     header("location:./pos_view.php");
    //     exit();
    // }

    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="invoice">
                 <div class="invoice-print">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="invoice-title">
                                 <h2>Invoice</h2>
                                 <div class="invoice-number">Invoice #<?php echo $invoice_no   ?></div>
                             </div>
                             <hr>
                             <?php
                                $users = "SELECT * FROM `pos_user` WHERE `invoice_no`='$invoice_no'";
                                $uql = mysqli_query($conn, $users);
                                $fetched = mysqli_fetch_assoc($uql);
                                ?>
                             <div class="row mb-3">
                                 <div class="col-md-6">
                                     <address>
                                         <strong>Purchased By:</strong><br>
                                         <?php echo $fetched['name']   ?><br>
                                         <strong>Phone NO.</strong><br>
                                         <?php echo $fetched['p_number']    ?>
                                     </address>
                                 </div>
                                 <div class="col-md-6 text-md-right">
                                     <strong>Cashier Email:</strong> <br>
                                     <?php echo $fetched['adm_email']    ?>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <address>
                                         <strong>Payment Status:</strong><br>
                                         <?php echo ucfirst($fetched['status'])    ?>
                                     </address>
                                 </div>
                                 <div class="col-md-6 text-md-right">
                                     <address>
                                         <strong>Order Date:</strong><br>
                                         <?php echo $fetched['date']   ?>
                                     </address>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-4">
                         <div class="col-md-12">
                             <div class="section-title">Order Summary</div>
                             <p class="section-lead">All items here cannot be deleted.</p>
                             <div class="table-responsive">
                                 <table class="table table-striped table-hover table-md">
                                     <tr>
                                         <th data-width="40">#</th>
                                         <th>Item</th>
                                         <th class="text-center">Price</th>
                                         <th class="text-center">Quantity</th>
                                         <th class="text-right">Totals</th>
                                     </tr>
                                     <?php
                                        $g_total = null;
                                        $query = "SELECT * FROM `pos_orders` WHERE `invoice_no`='$invoice_no' ";
                                        $sql = mysqli_query($conn, $query);
                                        while ($order = mysqli_fetch_assoc($sql)) {
                                        ?>
                                         <tr>
                                             <td>1</td>
                                             <td><?php echo $order['p_name']    ?></td>
                                             <td class="text-center"><?php echo $order['p_price']    ?> PKR</td>
                                             <td class="text-center"><?php echo $order['p_qty']    ?></td>
                                             <td class="text-right"><?php echo $order['total_price']    ?> PKR</td>
                                         </tr>
                                     <?php
                                            $g_total += $order['total_price'];
                                        }
                                        ?>

                                 </table>
                             </div>
                             <div class="row mt-4 justify-content-end">
                                 <div class="col-lg-4 text-right">
                                     <div class="invoice-detail-item">
                                         <div class="invoice-detail-name">Subtotal</div>
                                         <div class="invoice-detail-value"><?php echo $g_total    ?> PKR</div>
                                     </div>
                                     <div class="invoice-detail-item">
                                         <div class="invoice-detail-name">Shipping</div>
                                         <div class="invoice-detail-value">
                                             <?php
                                                $shipp_cost = ($g_total * (5 / 100));
                                                echo $shipp_cost;
                                                ?> PKR</div>
                                     </div>
                                     <hr class="mt-2 mb-2">
                                     <div class="invoice-detail-item">
                                         <div class="invoice-detail-name">Total</div>
                                         <div class="invoice-detail-value invoice-detail-value-lg">
                                             <?php
                                                $final_total = $g_total + $shipp_cost;
                                                echo $final_total;
                                                ?> PKR</div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <hr>
                 <div class="text-md-right">
                     <div class="float-lg-left mb-lg-0 mb-3">
                         <a href="./view_orders.php" class="btn btn-primary">Back To Order</a>
                     </div>
                     <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                 </div>
             </div>
         </div>
     </section>
 </div>

 <?php
    include "./include/footer.php";
    ?>

 <script>
     document.getElementById('print').addEventListener('click', function() {

         const printContents = document.querySelector('.invoice-print').innerHTML;
         const originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;

         window.location.reload();
     });
 </script>