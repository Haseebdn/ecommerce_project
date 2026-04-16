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
                                             <th>Image</th>
                                             <th>Category</th>
                                             <th>Subcategory</th>
                                             <th>Name</th>
                                             <th>Quantity</th>
                                             <th>Status</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT p.*,cat.cat_name AS category_name,subcat.cat_name AS subcat_name FROM products AS p 
                                            INNER JOIN categories AS cat ON p.cat_id=cat.id
                                            INNER JOIN categories AS subcat ON p.subcat_id=subcat.id";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><img src="./uploads/thumbnail/<?php echo $row['p_thumbnail'] ?? '' ?>" alt="image" width="50"></td>
                                                 <td><?php echo $row['category_name']    ?></td>
                                                 <td><?php echo $row['subcat_name']    ?></td>
                                                 <td><?php echo $row['p_name']    ?></td>
                                                 <td><?php echo $row['qty']    ?></td>
                                                 <td class="pt-3">
                                                     <label class="custom-switch pl-0">
                                                         <input onchange="fetchstatus(<?php echo $row['id'] ?>, 'products')"
                                                             id="switch_<?php echo $row['id']; ?>" <?php echo ($row['is_active'] == 1) ? 'checked' : '' ?> type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                         <span class="custom-switch-indicator"></span>
                                                         <span class="custom-switch-description">Active</span>
                                                     </label>
                                                 </td>
                                                 <td>
                                                     <a class="btn btn-primary btn-sm" href="./product_form.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                                                     <a class="btn btn-danger btn-sm" href="./handlers/product/delete.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                                     <a class="btn btn-dark btn-sm" href="./product_preview.php?id=<?php echo $row['id'] ?>">
                                                         <i class="fa-solid fa-display"></i>
                                                     </a>
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