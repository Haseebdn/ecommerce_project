<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";


if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];

    $query = "SELECT * FROM `categories` WHERE `id` = '$id'";

    $sql = mysqli_query($conn, $query);

    $record = mysqli_fetch_assoc($sql);
    // print_r($record);
    // die;
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
                            <h4><?php echo isset($_GET['id']) ? 'Update Subcategory' : 'Add Subcategory'    ?></h4>
                            <a href="./subcat_table.php" class="btn btn-primary">Subcategories</a>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="subcat_form" action="<?php echo isset($_GET['id']) ? './handlers/subcategory/update.php' : './handlers/subcategory/add.php' ?>" method="POST">
                            <div class="card-body">
                                <!-- input to edit -->
                                <input type="hidden" name='edit_index' value="<?php echo isset($record['id']) ? $record['id'] : '' ?>">
                                <!-- input to edit -->
                                <!-- query -->
                                <?php
                                $query = "SELECT * FROM `categories` WHERE `parent_id` IS NULL ";
                                $sql = mysqli_query($conn, $query);

                                ?>
                                <!-- query -->
                                <!-- category -->
                                <div class="form-group">
                                    <label>Category </label><span> *</span>
                                    <select id="category_name" name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['id'] ?>"
                                                <?php echo (isset($record['parent_id']) && $record['parent_id'] == $row['id']) ? 'selected' : '' ?>>
                                                <?php echo $row['cat_name'] ?>
                                            </option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <!-- category -->

                                <!-- subcategory -->
                                <div class="">
                                    <label>Subcategory Name </label><span> *</span>
                                    <input name="subcat_name" type="text" id="subcat_name" class="form-control" value="<?php echo isset($record['cat_name']) ? $record['cat_name'] : '' ?>" required>
                                </div>
                                <div id="subcat_error" class="text-danger mt-1"></div>
                                <!-- subcategory -->
                                <!-- description -->
                                <div class="mt-4">
                                    <label for="">
                                        Description
                                    </label>
                                    <textarea class="form-control" name="subcat_desc" id="subcat_desc"><?php echo isset($record['cat_description']) ? $record['cat_description'] : '' ?></textarea>
                                </div>
                                <div id="desc_error" class="text-danger mt-1"></div>
                                <!-- description -->
                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button id="cat_submit" class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'   ?></button>
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

        $('#subcat_name').on('input', function() {
            let input = this;
            let start = input.selectionStart;
            let end = input.selectionEnd;

            let value = input.value;

            let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

            input.value = capitalized;

            input.setSelectionRange(start, end);
        });

        $('#subcat_desc').on('input', function() {
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

        function validateName() {
            let name = $('#subcat_name').val().trim();
            let error = '';
            if (name !== "") {
                if (name.length < 3) {
                    error = "Too short";
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    error = "Numbers and special characters not allowed";
                }
                $('#subcat_error').text(error);
                return error === "";
            }
        }

        function validateDesc() {
            let desc = $('#subcat_desc').val().trim();
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
        $('#subcat_name').on('input', validateName);
        $('#subcat_desc').on('input', validateDesc);

        $("#subcat_form").on('submit', function(e) {
            let validName = validateName();
            let validDesc = validateDesc();

            if (!validName || !validDesc) {
                e.preventDefault();
            }
        })
        validateName();
        validateDesc();
    })
</script>