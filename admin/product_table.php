 <?php
    include "./include/header.php";
    include "./include/sidebar.php";
    include "./sql/conn.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <!-- alert -->

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
                                         <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td>
                                                 <label class="custom-switch pl-0">
                                                     <input onchange=""
                                                         id="" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                     <span class="custom-switch-indicator"></span>
                                                     <span class="custom-switch-description">Active</span>
                                                 </label>
                                             </td>
                                             <td>
                                                 <a class="btn btn-primary btn-sm" href=""><i class="fa-solid fa-pen"></i></a>
                                                 <a class="btn btn-danger btn-sm" href=""><i class="fa-solid fa-trash"></i></a>
                                                 <a class="btn btn-dark btn-sm" href=""><i class="fa-solid fa-display"></i></a>
                                             </td>
                                         </tr>
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