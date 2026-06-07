<?php
include "./sql/conn.php";
include "./includes/header.php";
?>

<style>
    @media (max-width: 768px) {
        #email_form {
            width: 100%;
        }

        #head {
            width: 100%;
        }

        .wrapper {
            width: 100%;
        }
    }

    @media (min-width: 768px) {
        #email_form {
            width: 75%;
        }

        #head {
            width: 75%;
        }

        .wrapper {
            width: 50%;
        }
    }
</style>
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

<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow-sm p-4" style="width:100%; max-width:420px;">
        <h2 class="mb-4">Change Email</h2>
        <form id="login_form" method="POST" action="handlers/login.php">
            <div class="mb-3">
                <label class="form-label fw-semibold">Old Email</label>
                <input id="old_email" class="form-control" type="email" name="old_email" value="<?php echo $_SESSION['user_email'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">New Email</label>
                <input id="new_email" class="form-control" type="email" name="new_email">
                <div id="new_error" class="text-danger mt-1"></div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input id="pass" class="form-control" type="password" name="pass">
                <div id="pass_error" class="text-danger mt-1"></div>
            </div>
            <div class="d-flex pb-2 mt-4 mb-1">
                <button type="submit" class="mr-3 btn btn-dark flex-fill">Change Email</button>
                <a class=" btn btn-danger flex-fill" href="./profile.php">Cancel</a>
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
            if (email == "") {
                error = "Enter New Email";
            } else if (email !== "") {
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