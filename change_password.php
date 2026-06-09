<?php
include "./sql/conn.php";
include "./includes/header.php";
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Change Password</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow-sm p-4" style="width:100%; max-width:420px;">
        <h2 class="mb-4">Change Password</h2>

        <form id="pass_form" method="POST" action="./handlers/change_password.php">

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input id="email" class="form-control" type="email" name="email"
                    value="<?php echo $_SESSION['user_email'] ?>" readonly>
                <div id="email_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Old Password</label>
                <input id="old_pass" class="form-control" type="password" name="old_pass">
                <div id="old_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input id="new_pass" class="form-control" type="password" name="new_pass">
                <div id="new_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input id="con_pass" class="form-control" type="password" name="con_pass">
                <div id="con_error" class="text-danger mt-1"></div>
            </div>

            <div class="d-flex pb-2 mt-4 mb-1">
                <button type="submit" class="mr-3 btn btn-dark flex-fill">
                    Change Password
                </button>
                <a class="btn btn-danger flex-fill" href="./profile.php">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>



<?php
include "./includes/footer.php";
?>

<script>
    $(document).ready(function() {

        <?php if (isset($_SESSION['success'])) { ?>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?php echo $_SESSION['success']; ?>",
                showConfirmButton: false,
                timer: 2000
            });

            <?php unset($_SESSION['success']); ?>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "<?php echo $_SESSION['error']; ?>",
                showConfirmButton: false,
                timer: 2000
            });
            <?php unset($_SESSION['error']); ?>
        <?php } ?>


        function validateOldPassword() {
            let password = $('#old_pass').val().trim();
            let error = '';

            if (password == "") {
                error = "Password is required";
            }

            $('#old_error').text(error);

            return error === '';
        }

        function validateNewPassword() {
            let password = $('#new_pass').val().trim();
            let error = '';


            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password == "") {
                error = "Password is required";
            } else if (!regex.test(password)) {
                error = "Min 8 chars, include upper, lower, number & special char";
            }

            $('#new_error').text(error);

            return error === '';
        }

        function confirmPassword() {
            let pass = $('#new_pass').val().trim();
            let con_pass = $('#con_pass').val().trim();
            let error = '';

            if (con_pass == '') {
                error = "Please Confirm Password";
            } else if (pass !== con_pass) {
                error = "Password Not Matched";
            }

            $('#con_error').text(error);
            return error === '';
        }

        $('#old_pass').on('input', validateOldPassword);
        $('#new_pass').on('input', validateNewPassword);
        $('#con_pass').on('input', confirmPassword);

        $('#pass_form').on('submit', function(e) {
            $('.btn').blur();
            let validOldPass = validateOldPassword();
            let validNewPass = validateNewPassword();
            let validConPass = confirmPassword();

            if (!validOldPass || !validNewPass || !validConPass) {
                e.preventDefault();
            }


        });
    })
</script>