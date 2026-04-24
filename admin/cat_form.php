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
              <h4><?php echo isset($_GET['id']) ? 'Update Category' : 'Add Category' ?></h4>
              <a href="./cat_table.php" class="btn btn-primary">Categories</a>
            </div>
            <!-- heading -->
            <!-- form -->
            <form id="cat_form" action="<?php echo isset($_GET['id']) ? './handlers/category/update.php' : './handlers/category/add.php' ?>" method="POST">

              <div class="card-body">
                <!-- index to edit -->
                <input type="hidden" name='edit_index' value="<?php echo isset($record['id']) ? $record['id'] : '' ?>">
                <!-- index to edit -->
                <!-- category name -->
                <div class="">
                  <label>Category Name</label><span class="text-danger ml-1">*</span>
                  <input name="cat_name" type="text" id="cat_name" class="form-control" value="<?php echo isset($record['cat_name']) ? $record['cat_name'] : '' ?>" required>
                </div>
                <div id="name_error" class="text-danger mt-1"></div>
                <!-- category name -->
                <!-- description -->
                <div class="mt-4">
                  <label for="">
                    Description
                  </label>
                  <textarea class="form-control" name="cat_description" id="cat_description"><?php echo isset($record['cat_description']) ? $record['cat_description'] : '' ?></textarea>
                </div>
                <div id="description_error" class="text-danger mt-1"></div>

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

    $('#cat_name').on('input', function() {
      let input = this;
      let start = input.selectionStart;
      let end = input.selectionEnd;

      let value = input.value;

      let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

      input.value = capitalized;

      input.setSelectionRange(start, end);
    });

    $('#cat_description').on('input', function() {
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
      let name = $("#cat_name").val().trim();
      let error = "";

      if (name !== "") {
        if (name.length < 3) {
          error = "Too Short";
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
          error = "Numbers and special characters not allowed";
        }
      }

      $("#name_error").text(error);
      return error === "";
    }


    function validateDescription() {
      let description = $("#cat_description").val().trim();
      let error = "";

      if (description !== "") {
        let wordCount = description.split(/\s+/).length;

        if (wordCount < 3) {
          error = "Description must be at least 3 words";
        }
      }

      $("#description_error").text(error);
      return error === "";
    }

    $("#cat_name").on("input", validateName);
    $("#cat_description").on("input", validateDescription);

    $("#cat_form").on("submit", function(e) {
      let isNameValid = validateName();
      let isDescValid = validateDescription();

      if (!isNameValid || !isDescValid) {
        e.preventDefault();
      }
    });

    validateName();
    validateDescription();

  });
</script>