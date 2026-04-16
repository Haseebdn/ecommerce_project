 <?php
    include "./include/header.php";
    include "./include/sidebar.php";
    include "./sql/conn.php";


    if (isset($_GET) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `products` WHERE `id`=$id";
        $sql = mysqli_query($conn, $query);
        $record = mysqli_fetch_assoc($sql);
        // print_r($record);
        // die();

    }

    ?>


 <!-- Main Content -->
 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row  justify-content-center">
                 <div class="col-12 col-md-6 col-lg-6">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header d-flex justify-content-between">
                             <h4><?php echo isset($_GET['id']) ? 'Update Product' : 'Add Product';    ?></h4>
                             <a href="./product_table.php" class="btn btn-primary">Products</a>
                         </div>
                         <!-- heading -->
                         <!-- form -->
                         <form action="<?php echo isset($_GET['id']) ? './handlers/product/update.php' : './handlers/product/add.php' ?>" method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <!-- input to edit -->
                                 <input type="hidden" name='edit_index' value="<?php echo $_GET['id'] ?>">
                                 <!-- input to edit -->
                                 <!-- query -->

                                 <!-- query -->
                                 <!-- category -->
                                 <div class="form-group">
                                     <?php
                                        $query = "SELECT * FROM `categories` WHERE `parent_id` IS NULL";
                                        $sql = mysqli_query($conn, $query);
                                        ?>
                                     <label> Category</label>
                                     <select id="cat_name" name="cat_id" class="form-control">
                                         <option>Select Category</option>
                                         <?php
                                            while ($cat = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <option value="<?php echo $cat['id'] ?>" <?php echo (isset($record['cat_id']) && $record['cat_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                                 <?php echo $cat['cat_name'] ?>
                                             </option>
                                         <?php
                                            }
                                            ?>
                                     </select>
                                 </div>
                                 <!-- category -->

                                 <!-- subcategory -->
                                 <div class="form-group">
                                     <label>Subcategory</label>
                                     <select id="subcat_name" name="subcat_id" class="form-control">
                                         <option>Select Subcategory</option>

                                     </select>
                                 </div>
                                 <!-- subcategory -->

                                 <!-- supplier -->
                                 <?php
                                    $query = "SELECT * FROM `suppliers`";
                                    $sql = mysqli_query($conn, $query);
                                    ?>
                                 <div class="form-group">
                                     <label>Supplier</label>
                                     <select id="supp_name" name="supp_id" class="form-control">
                                         <option>Select Supplier</option>
                                         <?php while ($supp = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <option value="<?php echo $supp['id'] ?>" <?php echo isset($record['supp_id']) == $supp['id'] ? 'Selected' : '' ?>><?php echo $supp['supp_name']   ?></option>
                                         <?php
                                            }
                                            ?>
                                     </select>
                                 </div>
                                 <!-- supplier -->

                                 <!-- code -->
                                 <div class="form-group">
                                     <label>Product Code</label>
                                     <input type="text" class="form-control" name="p_code" value="<?php echo @$record['p_code'] ?>" required>
                                 </div>
                                 <!-- code -->

                                 <!-- name -->
                                 <div class="form-group">
                                     <label>Product Name</label>
                                     <input type="text" class="form-control" name="p_name" value="<?php echo @$record['p_name'] ?>" required>
                                 </div>
                                 <!-- name -->

                                 <!-- description -->
                                 <div>
                                     <label for="">Description</label>
                                     <textarea class="form-control mb-4" name="p_description" id="p_description"><?php echo @$record['p_description'] ?></textarea>
                                 </div>
                                 <!-- description -->

                                 <!-- unit price -->
                                 <div class="form-group">
                                     <label>Unit Price</label>
                                     <input type="number" class="form-control" name="unit_price" value="<?php echo @$record['unit_price'] ?>" required>
                                 </div>
                                 <!-- unit price -->

                                 <!-- sale price -->
                                 <div class="form-group">
                                     <label>Sale Price</label>
                                     <input type="number" class="form-control" name="sale_price" value="<?php echo @$record['sale_price'] ?>">
                                 </div>
                                 <!-- sale price -->

                                 <!-- Quantity -->
                                 <div class="form-group">
                                     <label>Quantity</label>
                                     <input type="number" class="form-control" name="qty" value="<?php echo @$record['qty'] ?>">
                                 </div>
                                 <!-- Quantity -->

                                 <!-- Stock -->
                                 <div class="form-group">
                                     <label class="fs-6">Stock</label>
                                     <input type="number" class="form-control" name="stock" value="<?php echo @$record['stock'] ?>" required>
                                 </div>
                                 <!-- Stock -->
                                 <!-- thumbnail -->
                                 <label>Product Thumbnail</label>
                                 <div class="custom-file mb-4">
                                     <input type="file" class="custom-file-input" id="customFile" name="p_thumbnail">
                                     <label class="custom-file-label" for="">Choose file</label>
                                 </div>
                                 <?php if (!empty($record['p_thumbnail'])) { ?>
                                     <div class="mb-4"><img class=" rounded rounded-2" src="./uploads/thumbnail/<?php echo @$record['p_thumbnail']; ?>" width="60"></div>
                                 <?php } ?>
                                 <!-- thumbnail -->
                                 <!-- Product Images -->
                                 <label>Product Images</label>
                                 <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="customFile" name="p_imgs[]" multiple>
                                     <label class="custom-file-label" for="">Choose file</label>
                                 </div>
                                 <!-- Product Images -->
                             </div>
                             <!-- buttons -->
                             <div class="card-footer text-right">
                                 <button id="cat_submit" class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'    ?></button>
                                 <button class="btn btn-secondary" type="reset">Reset</button>
                             </div>
                             <!-- buttons -->
                         </form>
                         <!-- form -->
                     </div>
                 </div>
             </div>
         </div>
     </section>

 </div>


 <?php
    include "./include/footer.php";
    ?>
 <script>
     $(document).ready(function() {

         let catId = $('#cat_name').val();
         let selectedSubcat = "<?php echo $record['subcat_id'] ?? ''; ?>";

         if (catId) {
             fetchSubcategories(catId, selectedSubcat);
         }
     });

     function fetchSubcategories(catId, selectedSubcat = '') {

         $.ajax({
             url: "./handlers/product/fetch_subcat.php",
             method: "POST",
             data: {
                 id: catId
             },
             success: function(res) {

                 let response = JSON.parse(res);

                 if (response.status == 200) {

                     let html = '';

                     response.data.forEach(subcat => {

                         let selected = (subcat.id == selectedSubcat) ? 'selected' : '';

                         html += `<option value="${subcat.id}" ${selected}>${subcat.cat_name}</option>`;
                     });

                     $("#subcat_name").html(html);
                 }
             }
         });
     }

     $('#cat_name').on('change', function() {
         fetchSubcategories(this.value);
     });
 </script>
