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
                             <h4>Unit Table</h4>
                             <a href="./qtyUnit_form.php" class="btn btn-primary">Add Unit</a>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->
                                     <thead>
                                         <tr>
                                             <th>Unit Name</th>
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
                                            $query = "SELECT * FROM `qty_units`";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><?php echo $row['unit_name']  ?></td>
                                                 <td><?php echo $row['unit_description'] ?? '' ?></td>
                                                 <!-- switch -->
                                                 <td>
                                                     <label class="custom-switch pl-0">
                                                         <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'qty_units')"
                                                             id="switch_<?php echo $row['id']; ?>"
                                                             <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                         <span class="custom-switch-indicator"></span>
                                                         <span class="custom-switch-description">Active</span>
                                                     </label>
                                                 </td>
                                                 <!-- switch -->
                                                 <td><?php echo $row['created_at']    ?></td>
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./qtyUnit_form.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen"></i></a>
                                                     <a class="btn btn-danger btn-sm" href="./handlers/qty_units/delete.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i></a>
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