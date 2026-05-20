<?php
include "sql/conn.php";
$fEmail = @$_SESSION['forgot_email'];
$code = @$_SESSION['code'];
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MODRAZE</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_bag" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php

    $cart_count = 0;
    $grand_total = 0;

    if (isset($_SESSION['user_email'])) {

        $email = $_SESSION['user_email'];

        $cartQuery = "SELECT 
                    COUNT(id) as total_items,
                    SUM(total_price) as total_price
                  FROM cart
                  WHERE u_email='$email'";

        $cartRun = mysqli_query($conn, $cartQuery);

        if ($cartRun && mysqli_num_rows($cartRun) > 0) {

            $cartData = mysqli_fetch_assoc($cartRun);

            $cart_count = $cartData['total_items'] ?? 0;
            $grand_total = $cartData['total_price'] ?? 0;
        }
    }

    ?>
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="../profile.php" class="text-capitalize">My Account</a>
                <a href="<?php echo isset($_SESSION['user_email']) ? './handlers/logout.php' : './login.php'   ?>" class="text-dark"><?php echo isset($_SESSION['user_email']) ? 'Logout' : 'Login'   ?></a>
            </div>

        </div>
        <div class="offcanvas__nav__option">
            <!-- <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a> -->
            <a href="./shopping_cart.php">
                <img src="img/icon/cart.png" alt="">
                <span class="font-weight-bold h1"><?php echo $cart_count; ?></span>
            </a>

            <div class="price">
                <?php echo number_format($grand_total); ?>
                <span> PKR</span>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="../profile.php" class="text-capitalize">My Account</a>
                            </div>
                            <div class="header__top__hover">
                                <a href="<?php echo isset($_SESSION['user_email']) ? './handlers/logout.php' : './login.php'   ?>" class="text-white"><?php echo isset($_SESSION['user_email']) ? 'Logout' : 'Login'   ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <img src="img/logo.png" alt="" class="w-75">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./checkout.php">Checkout</a></li>
                            <li><a href="./contact.php">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-lg-3 col-md-3">
                    <div id="cart_icon_div" class="header__nav__option">

                        <a href="shopping_cart.php">
                            <div id="icon_no_div">
                                <i class=" text-dark material-symbols-outlined">
                                    shopping_bag
                                </i>
                                <span id="cart_icon_no" class="font-weight-bold text-dark h5"><?php echo $cart_count; ?></span>
                            </div>
                        </a>
                        <span id="cart_price_header"><?php echo number_format($grand_total); ?>
                            <span> PKR</span></span>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->


    <div class="container my-5 otp-div">

        <h2 class="px-4 otp_head">Change Password</h2>

        <form id="otp_form" method="POST" class="my-4 px-4" action="./handlers/forgot_pass.php">

            <div class="row forgot-row">

                <div class="col col-md-6 col-12 forgot-div pb-4">
                    <label for="">Email</label>

                    <input id="forgot_email" name="email" class="form-control forgot_input" type="email"  value="<?php echo $fEmail ?>" readonly>

                    <div id="email_error" class="text-danger mt-1"></div>
                </div>

                <div class="col col-md-6 col-sm-12 forgot-div pb-4">
                    <label for="">OTP Code</label>

                    <input id="otp_code" name="otp" class="form-control forgot_input" type="number" tabindex="1">

                    <div id="code_error" class="text-danger mt-1"></div>
                </div>

            </div>

            <div class="row forgot-row">

                <div class="col col-md-6 col-sm-12 forgot-div pb-4">
                    <label for="">New Password</label>

                    <input id="new_pass" name="new_pass" class="form-control forgot_input" type="password" tabindex="2">

                    <div id="newpass_error" class="text-danger mt-1"></div>
                </div>

                <div class="col col-md-6 col-sm-12 forgot-div pb-4">
                    <label for="">Confirm Password</label>

                    <input id="con_pass" name="con_pass" class="form-control forgot_input" type="password" tabindex="3">

                    <div id="conpass_error" class="text-danger mt-1"></div>
                </div>

            </div>

            <div class=" my-4 row">

                <div class=" col col col-md-5 col-sm-10 ">
                    <button type="submit" class="btn btn-dark otp-btn">Submit</button>
                </div>

            </div>

        </form>
    </div>

    <?php
    include "./includes/footer.php";
    ?>

    <script>
        $(document).ready(function() {

            // Email validation
            function validateEmail() {

                let email = $('#forgot_email').val().trim();
                let error = '';

                if (email == "") {

                    error = "Please Enter Email";

                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {

                    error = "Invalid Email";
                }

                $('#email_error').text(error);
                return error === '';
            }

            // OTP validation
            function validateOTP() {

                let otp = $('#otp_code').val().trim();
                let sessionCode = "<?php echo $code; ?>";
                let error = '';

                if (otp == '') {

                    error = "Please Enter OTP";

                } else if (!/^\d{6}$/.test(otp)) {

                    error = "OTP must be exactly 6 digits";

                } else if (otp !== sessionCode) {

                    error = "Invalid OTP Code";
                }

                $('#code_error').text(error);
                return error === '';
            }

            // Password validation
            function validatePassword() {

                let password = $('#new_pass').val().trim();
                let error = '';

                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (password == "") {

                    error = "Password is required";

                } else if (!regex.test(password)) {

                    error = "Min 8 chars, include upper, lower, number & special char";
                }

                $('#newpass_error').text(error);
                return error === '';
            }

            // Confirm password validation
            function confirmPassword() {

                let pass = $('#new_pass').val().trim();
                let con_pass = $('#con_pass').val().trim();
                let error = '';

                if (con_pass == '') {

                    error = "Please Confirm Password";

                } else if (pass !== con_pass) {

                    error = "Password Not Matched";
                }

                $('#conpass_error').text(error);
                return error === '';
            }

            // Only numbers in OTP field
            $('#otp_code').on('input', function() {

                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 6) {
                    this.value = this.value.slice(0, 6);
                }

            });

            // Events
            $('#forgot_email').on('input', validateEmail);
            $('#otp_code').on('input', validateOTP);
            $('#new_pass').on('input', validatePassword);
            $('#con_pass').on('input', confirmPassword);

            // Form submit
            $('#otp_form').on('submit', function(e) {

                let validEmail = validateEmail();
                let validOTP = validateOTP();
                let validPassword = validatePassword();
                let validConPass = confirmPassword();

                if (!validEmail || !validOTP || !validPassword || !validConPass) {

                    e.preventDefault();
                }

            });

        });
    </script>