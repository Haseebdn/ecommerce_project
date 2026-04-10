 <?php
  include "./include/header.php";
  include "./include/sidebar.php";
  include "./sql/conn.php";

  ?>




 <!-- Main Content -->
 <div class="main-content">
   <section class="section">
     <div class="section-body">
       <?php
        if (isset($_GET['success'])) {
          if ($_GET['success'] == 1) {
        ?>
           <div class="alert text-center alert-success">Date saved successfully</div>
         <?php
          } else {
          ?>
           <div class="alert text-center alert-danger">Date save failed</div>
       <?php
          }
        }
        if (isset($_GET['delete-success'])) {
          if ($_GET['delete-success'] == 1) {
            echo '<div class="alert alert-success">Category Deleted successfully</div>';
          } else {
            echo '<div class="alert alert-success">Category Deletion Failed</div>';
          }
        }
        ?>
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header d-flex justify-content-between">
               <h4>Export Table</h4>
               <a href="./export-table.php" class="btn btn-primary">Add Category</a>
             </div>
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                   <thead>
                     <tr>
                       <th>Category</th>
                       <th>Description</th>
                       <th>Status</th>
                       <th>Actions</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $query = "SELECT * FROM `categories`";
                      $sql = mysqli_query($conn, $query);

                      while ($row = mysqli_fetch_assoc($sql)) {
                      ?>
                       <tr>
                         <td><?php echo $row['cat_name']; ?></td>
                         <td><?php echo $row['cat_description']; ?></td>
                         <td>
                           <label class="custom-switch pl-0">
                             <input onchange="fetchstatus(<?php echo $row['cat_id'] ?>, 'categories')"
                               id="switch_<?php echo $row['cat_id']; ?>"
                               <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                             <span class="custom-switch-indicator"></span>
                             <span class="custom-switch-description">Active</span>
                           </label>

                         </td>
                         <td>
                           <a class="btn btn-primary btn-md h1" href="./basic-form.php?id=<?php echo $row['cat_id']; ?>"><i class="fa-solid fa-pen"></i></a>
                           <a class="btn btn-danger btn-md h1" href="./handlers/category/delete.php?id=<?php echo $row['cat_id']; ?>"><i class="fa-solid fa-trash"></i></a>
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 </table>
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