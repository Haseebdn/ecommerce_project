 <?php
    include "./sql/conn.php";
    include "./include/header.php";
    include "./include/sidebar.php";
    ?>


 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-6">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header">
                             <h4>Products Table</h4>
                         </div>
                         <!-- heading -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <!-- table -->
                                 <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                     <!-- table head -->
                                     <thead>
                                         <tr>
                                             <th>Code</th>
                                             <th>Product</th>
                                             <th>Price</th>
                                             <th>Stock</th>
                                             <th>Quantity</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <!-- table head -->

                                     <!-- table body -->
                                     <tbody>
                                         <?php
                                            $query = "SELECT * FROM `products` WHERE `is_active`=1";
                                            $sql = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                             <tr>
                                                 <td><?php echo $row['p_code']    ?></td>
                                                 <td><?php echo $row['p_name']    ?></td>
                                                 <td><?php echo $row['sale_price']    ?> PKR</td>
                                                 <td><?php echo $row['qty']    ?></td>
                                                 <td>
                                                     <input class="form-control qty" type="number" value="1" min="1">
                                                 </td>
                                                 <td><button class="btn btn-primary addBtn" data-pid="<?php echo $row['id'] ?>">Add</button></td>
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
                 <div class="col-12 col-md-6 col-lg-6">
                     <div class="card">
                         <!-- heading -->
                         <div class="card-header d-flex justify-content-between">
                             <h4>POS</h4>
                             <a href="" class="btn btn-primary">View</a>
                         </div>
                         <!-- heading -->
                         <!-- form -->
                         <form id="user_form">
                             <div class="card-body">

                                 <!-- invoice no. -->
                                 <div>
                                     <label>Invoice Number</label><span class="text-danger ml-1">*</span>
                                     <input id="invoice_no" type="number" class="form-control" name="invoice_no" value="" readonly>
                                 </div>
                                 <div id="invoice_error" class="text-danger mt-1"></div>
                                 <!-- invoice no. -->

                                 <!-- name -->
                                 <div class="mt-4">
                                     <label>Name</label><span class="text-danger ml-1">*</span>
                                     <input type="text" id="name" class="form-control" name="name" required>
                                 </div>
                                 <div id="name_error" class="text-danger mt-1"></div>
                                 <!-- name -->

                                 <!-- phone number -->
                                 <div>
                                     <label class="mt-4">Phone Number</label><span class="text-danger ml-1">*</span>
                                     <input type="text" id="p_number" class="form-control" name="p_number" required>

                                 </div>
                                 <div id="phone_error" class="text-danger mt-1"></div>
                                 <!-- phone number -->

                                 <!-- total price -->
                                 <div class="mt-4">
                                     <label>Total Price</label><span class="text-danger ml-1">*</span>
                                     <input id="t_price" type="number" class="form-control" name="t_price" value="" readonly>
                                 </div>
                                 <div id="unit_error" class="text-danger mt-1"></div>
                                 <!-- total price -->

                                 <!-- payment status -->
                                 <div class="mt-4">

                                     <label>Payment Status</label><span class="text-danger ml-1">*</span>
                                     <select id="payment_status" name="payment_status" class="form-control">
                                         <option value="">Select Status</option>
                                         <option value="pending">Pending</option>
                                         <option value="completed">Completed</option>
                                     </select>
                                 </div>
                                 <!-- payment status -->
                             </div>
                         </form>
                         <!-- form -->

                         <!-- buttons -->
                         <div class="card-footer text-right">
                             <button type="button" id="cart_submit" class="btn btn-primary mr-1">
                                 Submit
                             </button>
                         </div>
                         <!-- buttons -->
                     </div>
                     <div class="card pos-items-card">
                         <!-- heading -->
                         <div class="card-header px-3 d-flex justify-content-between">
                             <h4>Cart</h4>
                             <a href="./handlers/pos/empty_cart.php" class="btn btn-danger">Empty</a>
                         </div>
                         <!-- heading -->

                         <!-- card body -->
                         <div class="card-body pos-items-body px-2">
                             <div class="table-responsive pos-table-div">
                                 <table class="table table-striped pos-cart-table ">
                                     <thead class="pos-items-head">
                                         <tr>
                                             <th class="th-pos-column">Code</th>
                                             <th class="th-pos-column">Product</th>
                                             <th class="th-pos-column">Price</th>
                                             <th class="th-pos-column">Qty</th>
                                             <th class="th-pos-column">Total Price</th>
                                             <th class="th-pos-column">Delete</th>
                                         </tr>
                                     </thead>

                                     <tbody id="cart_items">


                                     </tbody>
                                 </table>
                             </div>
                         </div>
                         <!-- card body -->

                         <!-- card footer -->
                         <div class=" d-flex justify-content-between pos-card-footer card-footer px-3">
                             <h5>Total Purchase:</h5>
                             <div>
                                 <span id="total_purchase" class="h5"></span> <span class="h5">PKR</span>
                             </div>
                         </div>
                         <!-- card footer -->
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

         $('.addBtn').on('click', function() {

             let btn = $(this); // current button

             let id = btn.data('pid');

             let qty = btn.closest('tr').find('.qty').val();

             $.ajax({

                 url: "/admin/handlers/pos/add_product.php",

                 method: "POST",

                 data: {
                     id: id,
                     qty: qty
                 },

                 success: function(res) {

                     let response = JSON.parse(res);

                     // remove focus/hover active effect
                     btn.blur();

                     if (response.status == 200) {

                         Swal.fire({
                             position: "center",
                             icon: "success",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                         loadCartItems();

                     } else {

                         Swal.fire({
                             position: "center",
                             icon: "error",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });

                     }

                 },

                 error: function() {

                     btn.blur();

                     Swal.fire({
                         position: "center",
                         icon: "error",
                         title: "Something went wrong",
                         showConfirmButton: false,
                         timer: 1500
                     });

                 }

             });

         });

         loadCartItems();

         function loadCartItems() {

             $.ajax({

                 url: "/admin/handlers/pos/cart_items.php",

                 method: "POST",

                 data: {
                     items: true
                 },

                 success: function(res) {

                     let response = JSON.parse(res);

                     console.log(response);

                     $('#cart_items').html(response.data);
                     $('#total_purchase').html(response.total_purchase);
                     $('#t_price').val(response.total_purchase);
                 }

             });

         }


         invoice();

         function invoice() {

             $.ajax({

                 url: "/admin/handlers/pos/invoice_no.php",

                 method: "POST",

                 data: {
                     invoice: true
                 },

                 success: function(res) {

                     let response = JSON.parse(res);

                     console.log(response);

                     if (response.status == 200) {

                         $('#invoice_no').val(response.data);

                     }

                 },

                 error: function() {

                     Swal.fire({
                         position: "center",
                         icon: "error",
                         title: "Failed to fetch invoice number",
                         showConfirmButton: false,
                         timer: 1500
                     });

                 }

             });

         }


         $('#cart_submit').on('click', function(e) {
             e.preventDefault();

             let form = $("#user_form");
             let formdata = new FormData(form[0]);

             $.ajax({
                 url: "/admin/handlers/pos/user.php",
                 method: "POST",
                 data: formdata,
                 processData: false,
                 contentType: false,

                 success: function(res) {
                     let response = JSON.parse(res);
                     $('#user_form')[0].reset();
                     loadCartItems();
                     invoice();

                     if (response.status == 200) {

                         Swal.fire({
                             position: "center",
                             icon: "success",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });

                     } else {
                         Swal.fire({
                             position: "center",
                             icon: "error",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                     }
                 },

                 error: function() {
                     Swal.fire({
                         position: "center",
                         icon: "error",
                         title: "Something went wrong",
                         showConfirmButton: false,
                         timer: 1500
                     });
                 }
             });
         });

         $(document).on('change', '.cart_qty', function(e) {
             e.preventDefault();

             let value = $(this).val();
             let id = $(this).data('qid');

             $.ajax({
                 url: "/admin/handlers/pos/qty_update.php",
                 method: "POST",
                 data: {
                     "qty": value,
                     "id": id
                 },
                 success: function(res) {
                     let response = JSON.parse(res);
                     if (response.status == 200) {
                         loadCartItems();
                         Swal.fire({
                             position: "center",
                             icon: "success",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });

                     } else {
                         Swal.fire({
                             position: "center",
                             icon: "error",
                             title: response.msg,
                             showConfirmButton: false,
                             timer: 1500
                         });
                     }
                 },

                 error: function() {
                     Swal.fire({
                         position: "center",
                         icon: "error",
                         title: "Something went wrong",
                         showConfirmButton: false,
                         timer: 1500
                     });
                 }
             })



         });

     });
 </script>