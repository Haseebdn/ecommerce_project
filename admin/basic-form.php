<?php
include "./include/header.php";
include "./include/sidebar.php";
include "./sql/conn.php";
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row  justify-content-center">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Add Category</h4>
            </div>
            <form action="./handlers/category/add.php"  method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label>Category Name</label>
                  <input name="cat_name" type="text" id="cat_name" class="form-control">
                </div>
                <div>
                  <label for="">
                    Description
                  </label>
                  <textarea class="form-control" name="cat_description" id="cat_description"></textarea>
                </div>
              </div>
              <div class="card-footer text-right">
                <button id="cat_submit" class="btn btn-primary mr-1" type="submit">Submit</button>
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