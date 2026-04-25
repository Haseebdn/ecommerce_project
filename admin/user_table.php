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
                             <h4>Products Table</h4>
                             <a href="./product_form.php" class="btn btn-primary">Add Product</a>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->
                                     <thead>
                                         <tr>
                                             <th>User Name</th>
                                             <th>User Email</th>
                                             <th>Role</th>
                                             <th>Status</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT adm.*,admR.role_name AS role_name,admR.id AS role_id FROM `admin` AS adm LEFT JOIN `admin_role` AS admR ON adm.adm_role=admR.id";
                                            $sql   = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                               
                                            ?>

                                             <tr>
                                                 <td><?php echo $row['adm_name'] ?? '' ?></td>
                                                 <td><?php echo $row['adm_email'] ?? '' ?></td>
                                                 <td><?php echo $row['role_name'] ?? ''    ?></td>
                                                 <td>
                                                     <label class="custom-switch pl-0">
                                                         <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'admin')"
                                                             id="switch_<?php echo $row['id']; ?>"
                                                             <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                         <span class="custom-switch-indicator"></span>
                                                         <span class="custom-switch-description">Active</span>
                                                     </label>
                                                 </td>
                                                 <td><a class="btn btn-primary btn-sm" href="./user_form.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                                                     <a class="btn btn-danger btn-sm" href="./handlers/adm_user/delete.php?id=<?php echo $row['id']  ?>"><i class="fa-solid fa-trash"></i></a>
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