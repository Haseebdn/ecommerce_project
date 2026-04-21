 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";

    if (isset($_GET['id']) && !empty($_GET)) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `qty_units` WHERE `id`=$id ";
        $sql = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql);
    }


    ?>

 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row d-flex justify-content-center">
                 <div class="col-12 col-md-6 col-lg-6">
                     <div class="card">
                         <!-- head -->
                         <div class="card-header  d-flex justify-content-between">
                             <h4><?php echo isset($_GET['id']) ? 'Update Units' : 'Add Units'    ?></h4>
                             <a href="./qtyUnit_table.php" class="btn btn-primary">Units</a>
                         </div>
                         <!-- head -->

                         <!-- form -->
                         <form id="unit_form" action="<?php echo isset($_GET['id']) ? './handlers/qty_units/update.php' : './handlers/qty_units/add.php' ?>" method="POST">
                             <div class="card-body">
                                 <input type="hidden" name="edit_index" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                 <!-- unit name -->
                                 <div class="">
                                     <label>Unit Name </label><span> *</span>
                                     <input type="text" id="unit_name" name="unit_name" class="form-control" value="<?php echo isset($row['unit_name']) ? $row['unit_name'] : '' ?>" required>
                                 </div>
                                 <div id="name_error" class="text-danger mt-1"></div>
                                 <!-- unit name -->

                                 <!-- description -->
                                 <div class="mt-4">
                                     <label>Description</label>
                                     <textarea id="unit_description" type="text" name="unit_description" class="form-control"><?php echo isset($row['unit_description']) ? $row['unit_description'] : '' ?></textarea>
                                 </div>
                                 <div id="desc_error" class="text-danger mt-1"></div>
                                 <!-- description -->
                                 <!-- buttons -->
                                 <div class="card-footer text-right">
                                     <button class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'    ?></button>
                                     <button class="btn btn-secondary" type="reset">Reset</button>
                                 </div>
                                 <!-- buttons -->

                             </div>

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

         $('#unit_name').on('input', function() {
             let input = this;
             let start = input.selectionStart;
             let end = input.selectionEnd;

             let value = input.value;

             let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

             input.value = capitalized;

             input.setSelectionRange(start, end);
         });

         $('#unit_description').on('input', function() {
             let input = this;
             let start = input.selectionStart;
             let end = input.selectionEnd;

             let value = input.value.toLowerCase();

             let result = value.replace(/(^\s*\w|[.!?]\s*\w)/g, function(char) {
                 return char.toUpperCase();
             });

             input.value = result;
             input.setSelectionRange(start, end);
         });

         function validateUnit() {
             let unit = $('#unit_name').val().trim();
             let error = '';

             if (unit !== "") {
                 if (!/^[a-zA-Z][a-zA-Z0-9_-]*$/.test(unit)) {
                     error = "Please enter valid unit ";
                 }
             }

             $('#name_error').text(error);
             return error === "";
         }


         function validateDesc() {
             let desc = $('#unit_description').val().trim();
             let error = '';
             if (desc !== "") {
                 let wordcount = desc.split(/\s+/).length;
                 if (wordcount < 3) {
                     error = "Description should be minimum 3 words";
                 }
             }
             $('#desc_error').text(error);
             return error === "";
         }

         $('#unit_name').on('input', validateUnit);
         $('#unit_description').on('input', validateDesc);

         $("#unit_form").on('submit', function(e) {
             let validName = validateUnit()
             let validDesc = validateDesc();

             if (!validDesc || !validName) {
                 e.preventDefault();
             }
         })

     });
 </script>