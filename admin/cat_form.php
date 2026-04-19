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
                  <label>Category Name</label>
                  <input name="cat_name" type="text" id="cat_name" class="form-control" value="<?php echo isset($record['cat_name']) ? $record['cat_name'] : '' ?>" required>
                </div>
                <div id="nameError" class="text-danger mt-1"></div>
                <!-- category name -->
                <!-- description -->
                <div class="mt-4">
                  <label for="">
                    Description
                  </label>
                  <textarea class="form-control" name="cat_description" id="cat_description"><?php echo isset($record['cat_description']) ? $record['cat_description'] : '' ?></textarea>
                </div>
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

    $("#cat_name").on("input", function() {
      let name = $(this).val();
      let error = "";

      if (name.length < 3) {
        error = "Too Short";
      }
      
      else if (!/^[a-zA-Z\s]+$/.test(name)) {
        error = "Numbers and special characters not allowed";
      }

      $("#nameError").text(error);
    });

    $("#cat_form").on("submit", function(e) {
      if ($("#nameError").text() !== "") {
        e.preventDefault();
      }
    });

  });
</script>