 <?php
  include "./include/header.php";
  include "./include/sidebar.php";
  include "./sql/conn.php";

  ?>

 <div class="main-content">
   <section class="section">
     <div class="section-body">
       <!-- alert -->
       <?php
        if (isset($_GET['supp'])) {
          if ($_GET['supp'] == 1) {
        ?>
           <div class="alert text-center alert-success">Data saved successfully</div>
         <?php
          } else {
          ?>
           <div class="alert text-center alert-danger">Data save failed</div>
       <?php
          }
        }
        if (isset($_GET['delete-supp'])) {
          if ($_GET['delete-supp'] == 1) {
            echo '<div class="alert alert-success">Subcategory Deleted successfully</div>';
          } else {
            echo '<div class="alert alert-success">Subcategory Deletion Failed</div>';
          }
        }
        ?>
       <!-- alert -->
       <div class="row">
         <div class="col-12">
           <div class="card">
             <!-- heading -->
             <div class="card-header d-flex justify-content-between">
               <h4>Supplier Table</h4>
               <a href="./supplier_form.php" class="btn btn-primary">Add Supplier</a>
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
                           <a class="btn btn-primary btn-sm" href="./supplier_form.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                           <a class="btn btn-danger btn-sm" href="./handlers/supplier/delete.php?id=<?php echo $row['id']  ?>"><i class="fa-solid fa-trash"></i></a>
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