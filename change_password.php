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

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h2>Provide Info</h2>
        <form id="pass_form" class="w-75 pb-3" action="">
            <div class="my-4">
                <label for="">
                    Email
                </label>
                <input id="email" class="form-control" type="email" name="email">
                <div id="email_error" class="text-danger mt-1"></div>
            </div>
            <div class="my-4">
                <label for="">
                    Old Password
                </label>
                <input id="old_pass" class="form-control" type="password" name="old_pass">
                <div id="old_error" class="text-danger mt-1"></div>
            </div>
            <div class="my-4">
                <label for="">
                    New Password
                </label>
                <input id="new_pass" class="form-control" type="password" name="new_pass">
                <div id="new_error" class="text-danger mt-1"></div>
            </div>
            <div class="my-4">
                <label for="">
                    Confirm Password
                </label>
                <input id="con_pass" class="form-control" type="password" name="con_pass">
                <div id="con_error" class="text-danger mt-1"></div>
            </div>
            <div class="my-4 w-100">
                <div><a class="w-100 btn btn-dark" href="">Change Password</a></div>
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
        $('#email').on('input', function() {
            let value = $(this).val().toLowerCase();
            $(this).val(value);
        });

        function validateEmail() {
            let email = $('#email').val().trim();
            let error = '';

            if (email !== "") {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    error = "Invalid Email";
                }
            }
            $('#email_error').text(error);
            return error === '';
        }

        function validateOldPassword() {
            let password = $('#old_pass').val().trim();
            let error = '';


            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password == "") {
                error = "Password is required";
            } else if (!regex.test(password)) {
                error = "Min 8 chars, include upper, lower, number & special char";
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

        $('#email').on('input', validateEmail);
        $('#old_pass').on('input', validateOldPassword);
        $('#new_pass').on('input', validateNewPassword);
        $('#con_pass').on('input', confirmPassword);

        $('#pass_form').on('input', function(e) {
            let validEmail = validateEmail();
            let validOldPass = validateOldPassword();
            let validNewPass = validateNewPassword();
            let validConPass = confirmPassword();

            if (!validEmail || !validOldPass || !validNewPass || !validConPass) {

                e.preventDefault();
            }

        })
    })
</script>