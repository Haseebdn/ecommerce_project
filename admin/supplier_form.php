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
                        <form id="supp_form" action="<?php echo isset($_GET['id']) ? './handlers/supplier/update.php' : './handlers/supplier/add.php'; ?>" method="POST">
                            <div class="card-body">

                                <input type="hidden" name="edit_index" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                <!-- supplier -->
                                <div class="">
                                    <label>Supplier Name </label><span> *</span>
                                    <input type="text" id="supp_name" name="supp_name" class="form-control" value="<?php echo isset($row['supp_name']) ? $row['supp_name'] : '' ?>" required>
                                </div>
                                <div id="supp_error" class="text-danger mt-1"></div>
                                <!-- supplier -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label>Email </label><span> *</span>
                                    <input id="supp_email" type="email" name="supp_email" class="form-control" value="<?php echo isset($row['supp_email']) ? $row['supp_email'] : '' ?>" required>
                                </div>
                                <div id="email_error" class="text-danger mt-1"></div>
                                <!-- email -->

                                <!-- phone no -->
                                <div class="mt-4">
                                    <label>TEL </label><span> *</span>
                                    <input id="supp_telno" type="tel" name="supp_telno" class="form-control" value="<?php echo isset($row['supp_telno']) ? $row['supp_telno'] : '' ?>" required>
                                </div>
                                <div id="telno_error" class="text-danger mt-1"></div>
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

<script>
    $(document).ready(function() {

        function validateName() {
            let name = $('#supp_name').val().trim();
            let error = '';

            if (name !== "") {
                if (name.length < 3) {
                    error = "Too short";
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    error = "Numbers and special letters not allowed";
                }
            }

            $('#supp_error').text(error);
            return error === '';
        }

        function validateEmail() {
            let email = $('#supp_email').val().trim();
            let error = '';

            if (email !== "") {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    error = "Invalid Email";
                }
            }
            $('#email_error').text(error);
            return error === '';
        }

        function validatePhone() {
            let phone = $('#supp_telno').val().trim();
            let error = '';

            if (phone !== "") {
                if (!/^(\+92|0)?3[0-9]{9}$/.test(phone)) {
                    error = "Invalid phone number";
                }
            }

            $('#tel_error').text(error);
            return error === '';
        }


        $('#supp_name').on('input', validateName);
        $('#supp_email').on('input', validateEmail);
        $('#supp_telno').on('input', validatePhone);

        $('#supp_form').on('submit', function(e) {
            let isValid = validateName();
            let emailValid = validateEmail();
            let phoneValid = validatePhone();

            if (!isValid || !emailValid || !phoneValid) {
                e.preventDefault();
            }
        });

        validateName();
        validateEmail();
        validatePhone()
    });
</script>