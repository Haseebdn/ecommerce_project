<?php
include "./sql/conn.php";

if (isset($_SESSION['admin_email'])) {
    header("location: /admin/home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body ">
                                <form id="login_form" method="POST" action="./handlers/login.php" class="needs-validation" novalidate="">
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                    ?>
                                        <div class="alert text-danger p-0 m-0 mb-2"><?php echo $_SESSION['error']   ?></div>
                                    <?php
                                        unset($_SESSION['error']);
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="adm_email" tabindex="1" required autofocus>
                                        <div id="email_error" class="text-danger mt-1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" id="password" class="control-label" name="password">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="adm_pass" tabindex="2" required>
                                        <div id="pass_error" class="text-danger mt-1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script>
        setTimeout(() => {
            const $alert = $('.alert');

            if ($alert.length) {
                $alert.fadeOut();
            }
        }, 2000);

        $('#email').on('input', function() {
            let value = $(this).val().toLowerCase();
            $(this).val(value);
        });

        function validateEmail() {
            let email = $('#email').val().trim();
            let error = '';

            if (email == "") {
                error = "Please fill in your email"
            } else
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                error = "Invalid Email";
            }
            $('#email_error').text(error);
            return error === '';
        }

        function validatePassword() {
            let password = $('#password').val().trim();
            let error = '';


            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password === "") {
                error = "Password is required";
            } else if (!regex.test(password)) {
                error = "Min 8 chars, include upper, lower, number & special char";
            }

            $('#pass_error').text(error);

            return error === '';
        }

        $('#email').on('submit', validateEmail);
        $('#password').on('input', validatePassword);


        $('#login_form').on('submit', function(e) {
            let emailValid = validateEmail();
            let passValid = validatePassword();

            if (!passValid || !emailValid) {
                e.preventDefault();
            }
        });
    </script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>