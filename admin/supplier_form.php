<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `suppliers` WHERE `id`='$id' ";
    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($sql);
}

?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <!-- heading -->
                        <div class="card-header">
                            <h4><?php echo isset($_GET['id']) ? 'Update Supplier' : 'Add Supplier'   ?></h4>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form action="<?php echo isset($_GET['id']) ? './handlers/supplier/update.php' : './handlers/supplier/add.php'; ?>" method="POST">
                            <div class="card-body">

                                <input type="hidden" name="edit_index" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                <!-- supplier -->
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input type="text" name="supp_name" class="form-control" value="<?php echo isset($row['supp_name']) ? $row['supp_name'] : '' ?>">
                                </div>
                                <!-- supplier -->

                                <!-- email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="supp_email" class="form-control" value="<?php echo isset($row['supp_email']) ? $row['supp_email'] : '' ?>">
                                </div>
                                <!-- email -->

                                <!-- phone no -->
                                <div class="form-group">
                                    <label>TEL</label>
                                    <input type="tel" name="supp_telno" class="form-control" value="<?php echo isset($row['supp_telno']) ? $row['supp_telno'] : '' ?>">
                                </div>
                                <!-- phone no -->

                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add' ?></button>
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