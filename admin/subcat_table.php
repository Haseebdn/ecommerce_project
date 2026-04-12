 <?php
  include "./include/header.php";
  include "./include/sidebar.php";
  include "./sql/conn.php";

  ?>




 <!-- Main Content -->
 <div class="main-content">
   <section class="section">
     <div class="section-body">
       <!-- alert -->
       <?php
        if (isset($_GET['progress'])) {
          if ($_GET['progress'] == 1) {
        ?>
           <div class="alert text-center alert-success">Data saved successfully</div>
         <?php
          } else {
          ?>
           <div class="alert text-center alert-danger">Data save failed</div>
       <?php
          }
        }
        if (isset($_GET['delete-progress'])) {
          if ($_GET['delete-progress'] == 1) {
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
                       <th>Subcategory</th>
                       <th>Category</th>
                       <th>Description</th>
                       <th>Status</th>
                       <th>Created At</th>
                       <th>Actions</th>
                     </tr>
                   </thead>
                   <!-- table head -->

                   <!-- table body -->
                   <tbody>

                     <?php
                      $query = "SELECT subcat.*,subcat.cat_id AS subcat_id,cat.cat_id AS cat_id, cat.cat_name AS parent_name 
                                           FROM categories AS subcat 
                                           LEFT JOIN categories AS cat 
                                             ON subcat.parent_id = cat.cat_id 
                                           WHERE subcat.parent_id IS NOT NULL";
                      $sql = mysqli_query($conn, $query);

                      while ($row = mysqli_fetch_assoc($sql)) {
                      ?>
                       <tr>
                         <td><?php echo $row['cat_name']; ?></td>
                         <td><?php echo $row['parent_name']    ?></td>
                         <td><?php echo $row['cat_description']; ?></td>
                         <!-- switch -->
                         <td>
                           <label class="custom-switch pl-0">
                             <input onchange="fetchstatus(<?php echo $row['subcat_id'] ?>, 'categories')"
                               id="switch_<?php echo $row['subcat_id']; ?>"
                               <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                             <span class="custom-switch-indicator"></span>
                             <span class="custom-switch-description">Active</span>
                           </label>
                         </td>
                         <!-- switch -->
                         <td><?php echo $row['created_at']; ?></td>
                         <!-- buttons -->
                         <td>
                           <a class="btn btn-primary btn-sm" href="./subcat_form.php?id=<?php echo $row['subcat_id']; ?>"><i class="fa-solid fa-pen"></i></a>
                           <a class="btn btn-danger btn-sm" href="./handlers/subcategory/delete.php?id=<?php echo $row['subcat_id']; ?>"><i class="fa-solid fa-trash"></i></a>
                         </td>
                         <!-- buttons -->
                       </tr>
                     <?php } ?>
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