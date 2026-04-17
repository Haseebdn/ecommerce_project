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
                         <form action="<?php echo isset($_GET['id']) ? './handlers/qty_units/update.php' : './handlers/qty_units/add.php' ?>" method="POST">
                             <div class="card-body">
                                 <input type="hidden" name="edit_index" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                 <!-- unit name -->
                                 <div class="form-group">
                                     <label>Unit Name</label>
                                     <input type="text" name="unit_name" class="form-control" value="<?php echo isset($row['unit_name']) ? $row['unit_name'] : '' ?>" required>
                                 </div>
                                 <!-- unit name -->

                                 <!-- description -->
                                 <div class="form-group">
                                     <label>Description</label>
                                     <textarea type="text" name="unit_description" class="form-control"><?php echo isset($row['unit_description']) ? $row['unit_description'] : '' ?></textarea>
                                 </div>
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