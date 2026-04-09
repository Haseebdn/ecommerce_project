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
                       <th colspan="2">Description</th>
                       <th></th>
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
                         <td colspan="2"><?php echo $row['cat_description']; ?></td>
                         <td></td>
                         <td>
                           <div class="form-check form-switch">
                             <input class="form-check-input status-toggle"
                               type="checkbox"
                               id="switch_<?php echo $row['cat_id']; ?>"
                               <?php echo ($row['is_active'] == 1) ? 'checked' : ''; ?>>
                             <label for="switch_<?php echo $row['cat_id']; ?>" class="form-check-label ml-2 fw-bold">
                              Active
                             </label>
                           </div>
                         </td>
                         <td>
                           <a class="btn btn-primary btn-sm" href="">Edit</a>
                           <a class="btn btn-danger btn-sm" href="">Delete</a>
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