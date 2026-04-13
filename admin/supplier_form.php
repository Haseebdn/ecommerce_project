 <?php
    include "./include/header.php";
    include "./include/sidebar.php";
    include "./sql/conn.php";

    ?>


 <!-- Main Content -->
 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">
                 <div class="col-12 col-md-6 col-lg-6">
                     <div class="card">
                         <div class="card-header">
                             <h4>Supplier Form</h4>
                         </div>
                         <form action="./handlers/supplier/add.php" method="POST">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label>Supplier Name</label>
                                     <input type="text" name="supp_name" class="form-control">
                                 </div>

                                 <div class="form-group">
                                     <label>Email</label>
                                     <input type="email" name="supp_email" class="form-control">
                                 </div>

                                 <div class="form-group">
                                     <label>TEL</label>
                                     <input type="tel" name="supp_telno" class="form-control">
                                 </div>

                             </div>
                             <div class="card-footer text-right">
                                 <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                 <button class="btn btn-secondary" type="reset">Reset</button>
                             </div>

                         </form>
                     </div>

                 </div>

             </div>

         </div>

     </section>

 </div>





 <?php
    include "./include/footer.php";
    ?>