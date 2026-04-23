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
                                             <th>Role Name</th>
                                             <th>Role Type</th>
                                             <th>Category</th>
                                             <th>Subcategory</th>
                                             <th>Supplier</th>
                                             <th>Qty Unit</th>
                                             <th>Product</th>
                                             <th>User Management</th>
                                             <th>Status</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `admin_role`";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><?php echo $row['role_name'] ?? ''    ?></td>
                                                 <td><?php echo $row['role_type'] ?? ''    ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['categories']   ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['subcategories']   ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['suppliers']   ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['qty_units']   ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['products']   ?></td>
                                                 <td><?php echo isset($row['role_type']) && ($row["role_type"] === 'All') ? '' : $row['adm_manage']   ?></td>
                                                 <!-- switch -->
                                                 <td>
                                                     <label class="custom-switch pl-0">
                                                         <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'admin_role')"
                                                             id="switch_<?php echo $row['id']; ?>"
                                                             <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                         <span class="custom-switch-indicator"></span>
                                                         <span class="custom-switch-description">Active</span>
                                                     </label>
                                                 </td>
                                                 <!-- switch -->
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./role_form.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                                                     <a class="btn btn-danger btn-sm" href="./handlers/adm_role/delete.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a>
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