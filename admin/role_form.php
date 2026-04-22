<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";


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
                            <h4>Add Role</h4>
                            <a href="./role_table.php" class="btn btn-primary">Roles</a>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="subcat_form" action="" method="POST">
                            <div class="card-body">
                                <!-- input to edit -->
                                <input type="hidden" name='edit_index' value="">
                                <!-- input to edit -->

                                <!-- Role -->
                                <div class="">
                                    <label>Role Name </label><span> *</span>
                                    <input name="role_name" type="text" id="role_name" class="form-control" value="" required>
                                </div>
                                <div id="role_error" class="text-danger mt-1"></div>
                                <!-- subcategory -->

                                <!-- Role -->
                                <div class="mt-4">
                                    <label>Role Type </label><span> *</span>
                                    <select id="_name" name="category_id" class="form-control">
                                        <option value="">Select Role Type</option>
                                        <option value="All">All</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <!-- Role -->

                                <!-- access  boxes -->
                                <div id="access" class=" mt-4">
                                    
                                    <h6 class="">Access</h6>

                                    <div id="role_box" class="d-flex flex-column px-2">

                                        <div class="mt-2 ">
                                            <input type="checkbox" name="access[]" value="categories"> <span class="ml-1 mb-2">Categories</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="subcategories"> <span class="ml-1 mb-2">Subcategories</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="suppliers"> <span class="ml-1 mb-2">Suppliers</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="quantity_units"> <span class="ml-1 mb-2">Quantity Units</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="products"> <span class="ml-1 mb-2">Products</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="admin_management"> <span class="ml-1 mb-2">Admin Management</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- access  boxes -->

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
    $(document).ready(function() {

        $('#access').hide();

        $('#_name').on('change', function() {
            if ($(this).val() === 'Custom') {
                $('#access').slideDown();
            } else {
                $('#access').slideUp();
            }
        });

    });
</script>