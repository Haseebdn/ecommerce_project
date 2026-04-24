<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";

if (isset($_GET) && !empty($_GET)) {
    $id = $_GET['id'];

    $query = "SELECT * FROM `admin_role` WHERE `id`=$id";
    $sql = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($sql);
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
                            <h4><?php echo isset($_GET['id']) ? 'Update Role' : 'Add Role'    ?></h4>
                            <a href="./role_table.php" class="btn btn-primary">Roles</a>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="role_form" action="<?php echo isset($_GET['id']) ? './handlers/adm_role/update.php' : './handlers/adm_role/add.php' ?>" method="POST">
                            <div class="card-body">
                                <!-- input to edit -->
                                <input type="hidden" name='edit_index' value="<?php echo $_GET['id'] ?? '' ?>">
                                <!-- input to edit -->

                                <!-- Role -->
                                <div class="">
                                    <label>Role Name</label><span class="text-danger ml-1">*</span>
                                    <input name="role_name" type="text" id="role_name" class="form-control" value="<?php echo @$record['role_name'] ?>" required>
                                </div>
                                <div id="role_error" class="text-danger mt-1"></div>
                                <!-- subcategory -->

                                <!-- Role -->
                                <div class="mt-4">
                                    <label>Role Type</label><span class="text-danger ml-1">*</span>
                                    <select id="role_type" name="role_type" class="form-control">
                                        <option value="">Select Role Type</option>
                                        <option value="All" <?php echo (isset($record['role_type']) && $record['role_type'] == 'All') ? 'selected' : '' ?>>All</option>
                                        <option value="Custom" <?php echo (isset($record['role_type']) && $record['role_type'] == 'Custom') ? 'selected' : '' ?>>Custom</option>
                                    </select>
                                </div>
                                <!-- Role -->

                                <!-- access  boxes -->
                                <div id="access" class=" mt-4">

                                    <h6 class="">Access</h6>

                                    <div id="role_box" class="d-flex flex-column px-2">

                                        <div class="mt-2 ">
                                            <input type="checkbox" name="access[]" value="categories" <?php echo (isset($record['categories']) && $record['categories'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Categories</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="subcategories" <?php echo (isset($record['subcategories']) && $record['subcategories'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Subcategories</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="suppliers" <?php echo (isset($record['suppliers']) && $record['suppliers'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Suppliers</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="quantity_units" <?php echo (isset($record['qty_units']) && $record['qty_units'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Quantity Units</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="products" <?php echo (isset($record['products']) && $record['products'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Products</span>
                                        </div>

                                        <div class="mt-2">
                                            <input type="checkbox" name="access[]" value="admin_management" <?php echo (isset($record['adm_manage']) && $record['adm_manage'] == 1) ? 'checked' : '' ?>> <span class="ml-1 mb-2">Admin Management</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- access  boxes -->

                            </div>

                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button id="role_submit" class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'    ?></button>
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

        function toggleAccess() {
            let roleType = $('#role_type').val();

            if (roleType === 'Custom') {
                $('#access').slideDown();
            } else {
                $('#access').slideUp();
            }
        }

        toggleAccess();

        $('#role_type').on('change', function() {
            toggleAccess();
        });


        function validateName() {
            let name = $('#role_name').val().trim();
            let error = '';
            if (name !== "") {
                if (name.length < 3) {
                    error = "Too short";
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    error = "Numbers and special characters not allowed";
                }
                $('#role_error').text(error);
                return error === "";
            }
        }

        $('#role_name').on('input', validateName);

        $("#role_form").on('submit', function(e) {
            let validName = validateName();


            if (!validName) {
                e.preventDefault();
            }
        })
    });
</script>