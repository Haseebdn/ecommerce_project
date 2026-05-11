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
                    <h4>Update Email</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Change Email</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h2>Change Email</h2>
        <form id="email_form" class="w-75 pb-3" action="">
            <div class="my-4">
                <label for="">
                    Old Email
                </label>
                <input id="old_email" class="form-control" type="email" name="old_email" value="<?php echo $_SESSION['user_email'] ?>" readonly>
            </div>
            <div class="my-4">
                <label for="">
                    New Email
                </label>
                <input id="new_email" class="form-control" type="email" name="new_email">
                <div id="new_error" class="text-danger mt-1"></div>

            </div>
            <div class="my-4">
                <label for="">
                    Current Password
                </label>
                <input id="pass" class="form-control" type="password" name="pass">
                <div id="pass_error" class="text-danger mt-1"></div>

            </div>
            <div class="my-4 w-100">
                <div><a class="w-100 btn btn-dark" href="">Change Email</a></div>
            </div>
            <div class="my-3 w-100">
                <div><a class=" w-100 btn btn-danger" href="./profile.php">Cancel</a></div>
            </div>
        </form>
    </div>


</div>



<?php
include "./includes/footer.php";
?>

<script>
    $(document).ready(function() {
        $('#new_email').on('input', function() {
            let value = $(this).val().toLowerCase();
            $(this).val(value);
        });

        function validateEmail() {
            let email = $('#new_email').val().trim();
            let error = '';

            if (email !== "") {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    error = "Invalid Email";
                }
            }
            $('#new_error').text(error);
            return error === '';
        }

        function validatePassword() {
            let password = $('#pass').val().trim();
            let error = '';


            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password == "") {
                error = "Password is required";
            } else if (!regex.test(password)) {
                error = "Min 8 chars, include upper, lower, number & special char";
            }

            $('#pass_error').text(error);

            return error === '';
        }

        $('#new_email').on('input', validateEmail);
        $('#pass').on('input', validatePassword);

        $('#email_form').on('submit', function(e) {
            let validEmail = validateEmail();
            let validPass = validatePassword();

            if (!validEmail || !validPass) {
                e.preventDefault();
            }
        })
    })
</script>