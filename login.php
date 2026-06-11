<?php
include "sql/conn.php";
if (isset($_SESSION['user_email'])) {
    header("location: index.php");
    exit();
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.min.css">
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
    <style>
        #togglePassword {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
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
                            <li><a href="./index.html">Home</a></li>
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


    <div class="container my-5 d-flex justify-content-center">
        <div class="card shadow-sm p-4" style="width:100%; max-width:435px;">
            <h2 class="mb-4">Login</h2>
            <form id="login_form" method="POST" action="handlers/login.php">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input id="u_email" name="email" class="form-control" type="email" tabindex="1">
                    <div id="email_error" class="text-danger mt-1 small"></div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-semibold">Password</label>
                        <a class="small pt-1 text-primary" href="./forgot_otp.php">Forgot Password?</a>
                    </div>

                    <div class="position-relative">
                        <input id="password" name="pass" class="form-control pr-5" type="password" tabindex="2">

                        <span id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <div id="pass_error" class="text-danger mt-1 small"></div>
                </div>
                <div class="d-flex  pb-2 mt-4 mb-1">
                    <button type="submit" class=" mr-3 btn btn-dark flex-fill">Login</button>
                    <a href="signup.php" class="btn btn-danger flex-fill">Signup</a>
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
                position: "center",
                icon: "success",
                title: "<?php echo $_SESSION['success']; ?>",
                showConfirmButton: false,
                timer: 2000
            });
            
            <?php unset($_SESSION['success']); ?>
            <?php } ?>
            
            <?php if (isset($_SESSION['error'])) { ?>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "<?php echo $_SESSION['error']; ?>",
                showConfirmButton: false,
                timer: 2000
            });
            <?php unset($_SESSION['error']); ?>
            <?php } ?>
            
            $('#togglePassword').click(function() {

                let password = $('#password');
                let icon = $(this).find('i');

                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    password.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }

            });
            
            $('#u_email').on('input', function() {
                let value = $(this).val().toLowerCase();
                $(this).val(value);
            });

            function validateEmail() {
                let email = $('#u_email').val().trim();
                let error = '';
                if (email == "") {
                    error = "Enter Email"
                } else if (email !== "") {
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        error = "Invalid Email";
                    }
                }
                $('#email_error').text(error);
                return error === '';
            }

            function validatePassword() {
                let password = $('#password').val().trim();
                let error = '';

                if (password == "") {
                    error = "Password is required";
                }
                $('#pass_error').text(error);

                return error === '';
            }

            $('#u_email').on('input', validateEmail);
            $('#password').on('input', validatePassword);

            $('#login_form').on('submit', function(e) {
                $('.btn').blur();
                let validEmail = validateEmail();
                let validPassword = validatePassword();
                if (!validEmail || !validPassword) {
                    e.preventDefault();
                }
            });
        });
    </script>