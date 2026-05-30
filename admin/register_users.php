 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header d-flex justify-content-between">
                             <h4>Mails Table</h4>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->


                                     <thead>
                                         <tr>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Phone Number</th>
                                             <th>Country</th>
                                             <th>City</th>
                                             <th>Gender</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `user`";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><?php echo $row['f_name'] . ' ' . $row['last_name']; ?></td>
                                                 <td><?php echo $row['u_email']    ?></td>
                                                 <td><?php echo $row['p_number']    ?></td>
                                                 <td><?php echo $row['country']    ?></td>
                                                 <td><?php echo $row['city']    ?></td>
                                                 <td><?php echo $row['gender']    ?></td>
                                                 <td>
                                                    <a class="btn btn-dark btn-sm" href=""><i class="fa-solid fa-display"></i></a>
                                                     <a class="btn btn-danger btn-sm deleteBtn" href="./handlers/customer/delete.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a>
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

<script>
   $(document).ready(function() {

     <?php if (isset($_SESSION['success'])) : ?>

       Swal.fire({
         position: "top-end",
         icon: "success",
         title: "<?php echo $_SESSION['success']; ?>",
         showConfirmButton: false,
         timer: 2000
       });

     <?php unset($_SESSION['success']);
      endif; ?>


     <?php if (isset($_SESSION['error'])) : ?>

       Swal.fire({
         position: "top-end",
         icon: "error",
         title: "<?php echo $_SESSION['success']; ?>",
         showConfirmButton: false,
         timer: 2000
       });

     <?php unset($_SESSION['error']);
      endif; ?>


     $(document).on('click', '.deleteBtn', function(e) {
       e.preventDefault();
       let link = $(this).attr('href');

       Swal.fire({
         title: "Are you sure?",
         text: "This subcategory will be deleted permanently!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#d33",
         cancelButtonColor: "#3085d6",
         confirmButtonText: "Yes, delete it!"
       }).then((result) => {
         if (result.isConfirmed) {
           window.location.href = link;
         }

       });


     });

   })
 </script>