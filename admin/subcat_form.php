<?php
include "./include/header.php";
include "./include/sidebar.php";
include "./sql/conn.php";


if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];

    $query = "SELECT * FROM `categories` WHERE `cat_id` = '$id'";

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
                        <div class="card-header d-flex justify-content-between">
                            <h4><?php  echo isset($_GET['id']) ? 'Update Subcategory' : 'Add Category'    ?></h4>
                            <a href="./subcat_table.php" class="btn btn-primary">Subcategories</a>
                        </div>
                        <form action="<?php echo isset($_GET['id']) ? './handlers/subcategory/update.php' : './handlers/subcategory/add.php'?>" method="POST">
                            <div class="card-body">
                                <input type="hidden" name='edit_index' value="<?php echo isset($record['cat_id']) ? $record['cat_id'] : '' ?>">

                                <?php
                                $query = "SELECT * FROM `categories` WHERE `parent_id` IS NULL ";
                                $sql = mysqli_query($conn, $query);

                                ?>

                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select id="category_name" name="category_id" class="form-control">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['cat_id'] ?>"
                                                <?php echo (isset($record['parent_id']) && $record['parent_id'] == $row['cat_id']) ? 'selected' : '' ?>>
                                                <?php echo $row['cat_name'] ?>
                                            </option>
                                            
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Subcategory Name</label>
                                    <input name="cat_name" type="text" id="cat_name" class="form-control" value="<?php echo isset($record['cat_name']) ? $record['cat_name'] : '' ?>">
                                </div>
                                <div>
                                    <label for="">
                                        Description
                                    </label>
                                    <textarea class="form-control" name="cat_description" id="cat_description"><?php echo isset($record['cat_description']) ? $record['cat_description'] : '' ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button id="cat_submit" class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'   ?></button>
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