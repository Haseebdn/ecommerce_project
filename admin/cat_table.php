 <?php
  include "./sql/conn.php";
  include "./include/header.php";
  include "./include/sidebar.php";
  ?>


 <!-- Main Content -->
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
               <h4>Category Table</h4>
               <a href="./cat_form.php" class="btn btn-primary">Add Category</a>
             </div>
             <!-- heading -->
             <div class="card-body">
               <div class="table-responsive">
                 <!--table -->
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
                     <!-- query -->
                     <?php
                      $query = "SELECT * FROM categories WHERE `parent_id` IS NULL";
                      $sql = mysqli_query($conn, $query);

                      // ===== query 
                      while ($row = mysqli_fetch_assoc($sql)) {
                      ?>
                       <tr>
                         <td><?php echo $row['cat_name']; ?></td>
                         <td><?php echo $row['cat_description']; ?></td>
                         <!-- switch -->
                         <td>
                           <label class="custom-switch pl-0">
                             <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'categories')"
                               id="switch_<?php echo $row['id']; ?>"
                               <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                             <span class="custom-switch-indicator"></span>
                             <span class="custom-switch-description">Active</span>
                           </label>
                         </td>
                         <!-- switch -->
                         <!-- buttons -->
                         <td>
                           <a class="btn btn-primary btn-sm" href="./cat_form.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen"></i></a>
                           <a class="btn btn-danger btn-sm" href="./handlers/category/delete.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i></a>
                         </td>
                         <!-- buttons -->
                       </tr>

                     <?php } ?>
                   </tbody>
                 </table>
                 <!--table -->
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