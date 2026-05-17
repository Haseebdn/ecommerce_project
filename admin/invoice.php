 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    $email = $_SESSION['user_email'];
    $order_no = null;

    if (isset($_GET)) {
        $order_no = $_GET['oNo'];
    }

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
                                 <div class="invoice-number">Order #<?php echo $order_no   ?></div>
                             </div>
                             <hr>
                             <?php
                                $users = "SELECT * FROM `user` WHERE `u_email`='$email'";
                                $uql = mysqli_query($conn, $users);
                                $fetched = mysqli_fetch_assoc($uql);
                                ?>
                             <div class="row">
                                 <div class="col-md-6">
                                     <address>
                                         <strong>Billed To:</strong><br>
                                         <?php echo $fetched['f_name'] . ' ' . $fetched['last_name'];     ?> <br>
                                         <?php echo $fetched['address']    ?>

                                     </address>
                                 </div>
                                 <?php
                                    $oUsers = "SELECT * FROM `order_user` WHERE `order_no`='$order_no'";
                                    $oUql = mysqli_query($conn, $oUsers);
                                    $oFetched = mysqli_fetch_assoc($oUql);
                                    ?>
                                 <div class="col-md-6 text-md-right">
                                     <address>
                                         <strong>Shipped To:</strong><br>
                                         <?php echo $oFetched['f_name'] . ' ' . $oFetched['last_name'];     ?><br>
                                         <?php echo $oFetched['od_address']    ?>
                                     </address>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <address>
                                         <strong>Payment Method:</strong><br>
                                         <?php echo $oFetched['payment_method']    ?><br>
                                         <?php echo $oFetched['od_email']    ?>
                                     </address>
                                 </div>
                                 <div class="col-md-6 text-md-right">
                                     <address>
                                         <strong>Order Date:</strong><br>
                                         <?php echo $oFetched['date']    ?><br><br>
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
                                        $query = "SELECT * FROM `orders` WHERE `order_no`='$order_no' ";
                                        $sql = mysqli_query($conn, $query);
                                        while ($order = mysqli_fetch_assoc($sql)) {
                                        ?>
                                         <tr>
                                             <td>1</td>
                                             <td><?php echo $order['p_name']    ?></td>
                                             <td class="text-center"><?php echo $order['price']    ?> PKR</td>
                                             <td class="text-center"><?php echo $order['p_qty']    ?></td>
                                             <td class="text-right"><?php echo $order['t_price']    ?> PKR</td>
                                         </tr>
                                     <?php
                                            $g_total += $order['t_price'];
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
                                         <div class="invoice-detail-value"><?php $shipp_cost = ($g_total * (5 / 100));
                                                                            echo $shipp_cost  ?> PKR</div>
                                     </div>
                                     <hr class="mt-2 mb-2">
                                     <div class="invoice-detail-item">
                                         <div class="invoice-detail-name">Total</div>
                                         <div class="invoice-detail-value invoice-detail-value-lg"><?php $final_total = $g_total + $shipp_cost;
                                        echo $final_total    ?> PKR</div>
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
         const printDiv = document.querySelector('.invoice-print').innerHTML;
         const originalPage = document.body.innerHTML;

         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;
         window.location.reload();
     });
 </script>