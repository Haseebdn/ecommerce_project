 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-6">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header">
                             <h4>Products Table</h4>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->
                                     <thead>
                                         <tr>
                                             <th>Image</th>
                                             <th>Product</th>
                                             <th>Product Code</th>
                                             <th>Price</th>
                                             <th>Quantity</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `products`";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><img id="p_img_table" class="img-fluid" src="./uploads/thumbnail/<?php echo $row['p_thumbnail'] ?? '' ?>" alt="image" width="50"></td>
                                                 <td><?php echo $row['p_name']    ?></td>
                                                 <td><?php echo $row['p_code']    ?></td>
                                                 <td><?php echo $row['sale_price']    ?> PKR</td>
                                                 <td><input class="form-control" type="number" value="1"></td>
                                                 <td><a class="btn btn-primary" href="">Add</a></td>
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