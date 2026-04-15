 <?php
    include "./include/header.php";
    include "./include/sidebar.php";
    include "./sql/conn.php";
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
                             <h4>Add Product</h4>
                             <a href="./subcat_table.php" class="btn btn-primary">Products</a>
                         </div>
                         <!-- heading -->
                         <!-- form -->
                         <form action="./handlers/product/add.php" method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <!-- input to edit -->
                                 <input type="hidden" name='edit_index' value="">
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
                                             <option value="<?php echo $cat['id'] ?>">
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
                                             <option value="<?php echo $supp['id'] ?>"><?php echo $supp['supp_name']   ?></option>
                                         <?php
                                            }
                                            ?>
                                     </select>
                                 </div>
                                 <!-- supplier -->

                                 <!-- code -->
                                 <div class="form-group">
                                     <label>Product Code</label>
                                     <input type="text" class="form-control" name="p_code" required>
                                 </div>
                                 <!-- code -->

                                 <!-- name -->
                                 <div class="form-group">
                                     <label>Product Name</label>
                                     <input type="text" class="form-control" name="p_name" required>
                                 </div>
                                 <!-- name -->

                                 <!-- description -->
                                 <div>
                                     <label for="">Description</label>
                                     <textarea class="form-control mb-4" name="p_description" id="p_description"></textarea>
                                 </div>
                                 <!-- description -->

                                 <!-- unit price -->
                                 <div class="form-group">
                                     <label>Unit Price</label>
                                     <input type="number" class="form-control" name="unit_price" required>
                                 </div>
                                 <!-- unit price -->

                                 <!-- sale price -->
                                 <div class="form-group">
                                     <label>Sale Price</label>
                                     <input type="number" class="form-control" name="sale_price">
                                 </div>
                                 <!-- sale price -->

                                 <!-- Quantity -->
                                 <div class="form-group">
                                     <label>Quantity</label>
                                     <input type="number" class="form-control" name="qty">
                                 </div>
                                 <!-- Quantity -->

                                 <!-- Stock -->
                                 <div class="form-group">
                                     <label class="fs-6">Stock</label>
                                     <input type="number" class="form-control" name="stock" required>
                                 </div>
                                 <!-- Stock -->

                                 <!-- Product Images -->
                                 <label>Product Images</label>
                                 <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="customFile" name="p_imgs" multiple>
                                     <label class="custom-file-label" for="">Choose file</label>
                                 </div>
                                 <!-- Product Images -->
                             </div>
                             <!-- buttons -->
                             <div class="card-footer text-right">
                                 <button id="cat_submit" class="btn btn-primary mr-1" type="submit">Add</button>
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
     $('#cat_name').on('change', function() {
         let id = this.value;
         $.ajax({
             url: "./handlers/product/fetch_subcat.php",
             method: "POST",
             data: {
                 'id': id
             },
             success: function(res) {
                 let response = JSON.parse(res);
                 //  console.log(response);

                 if (response.status == 200) {
                     let html = '';
                     response.data.forEach(subcat => {
                         html += `
                        <option value="${subcat.id}" >${subcat.cat_name}</option>
                    `;
                     });

                     // console.log(html);

                     $("#subcat_name").html(html);
                 }
             }
         })
     })
 </script>