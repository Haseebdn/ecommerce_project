 <?php
  include "./include/header.php";
  include "./include/sidebar.php";
  include "./sql/conn.php";

  ?>

 <div class="main-content">
   <section class="section">
     <div class="section-body">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <!-- heading -->
             <div class="card-header d-flex justify-content-between">
               <h4>Subcategory Table</h4>
               <a href="./subcat_form.php" class="btn btn-primary">Add Subcategory</a>
             </div>
             <!-- heading -->
             <div class="card-body">
               <div class="table-responsive">
                 <!-- table -->
                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                   <!-- table head -->
                   <thead>
                     <tr>
                       <th>Supplier</th>
                       <th>Email</th>
                       <th>Phone Number</th>
                       <th>Status</th>
                       <th>Created At</th>
                       <th>Actions</th>
                     </tr>
                   </thead>
                   <!-- table head -->

                   <!-- table body -->
                   <tbody>
                     <?php
                      $query = "SELECT * FROM `suppliers`";
                      $sql = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($sql)) {
                      ?>

                       <tr>
                         <td><?php echo $row['supp_name']    ?></td>
                         <td><?php echo $row['supp_email']    ?></td>
                         <td><?php echo $row['supp_telno']    ?></td>
                         <!-- switch -->
                         <td>
                           <label class="custom-switch pl-0">
                             <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'suppliers')"
                               id="switch_<?php echo $row['id']; ?>"
                               <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                             <span class="custom-switch-indicator"></span>
                             <span class="custom-switch-description">Active</span>
                           </label>
                         </td>
                         <!-- switch -->
                         <td><?php echo $row['created_at']    ?></td>
                         <!-- buttons -->
                         <td>
                           <a class="btn btn-primary btn-sm" href=""><i class="fa-solid fa-pen"></i></a>
                           <a class="btn btn-danger btn-sm" href=""><i class="fa-solid fa-trash"></i></a>
                         </td>
                         <!-- buttons -->
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