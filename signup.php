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
    <title>Male-Fashion | Template</title>

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
    <link rel="stylesheet" href="css/media_queries/signup.css">
    <link rel="stylesheet" href="css/signup.css">
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
                        <img src="img/logo.png" alt="" class="">
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


    <div class="container mt-5">
        <h2>Signup</h2>
        <form id="signup_form" action="./handlers/signup.php" method="POST" enctype="multipart/form-data" novalidate>
            <div class="row">
                <div class="div_input col-md-6">
                    <label for="">First Name</label><span class="text-danger"> *</span>
                    <input class="form-control" name="f_name" id="f_name" type="text" required>
                    <div id="f_error" class="text-danger mt-1"></div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">Last Name</label><span class="text-danger"> *</span>
                    <input class="form-control" id="last_name" name="last_name" type="text" required>
                    <div id="last_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="row">
                <div class="div_input col-md-6">
                    <label for="">Email</label><span class="text-danger"> *</span>
                    <input class="  form-control" id="u_email" name="u_email" type="email" required>
                    <div id="email_error" class="text-danger mt-1"></div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">Phone No.</label><span class="text-danger"> *</span>
                    <input class="  form-control" id="p_number" name="p_number" type="tel" required>
                    <div id="number_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="row">
                <div class="div_input col-md-6">
                    <label for="">Country</label><span class="text-danger"> *</span><br>
                    <div class="d-flex flex-column">
                        <select id="country" name="country" class="select custom-select" required>
                            <option value="">Select Country</option>
                            <option value="Pakistan">Pakistan</option>
                        </select>
                        <div id="country_error" class="text-danger mt-1"></div>
                    </div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">State</label><span class="text-danger"> *</span><br>
                    <div class="d-flex flex-column">
                        <select id="state" name="state" class=" select custom-select" required>
                            <option value="">Select State</option>
                            <option value="Punjab">Punjab</option>
                            <option value="KPK">KPK</option>
                            <option value="Balochistan">Balochistan</option>
                            <option value="Sindh">Sindh</option>
                        </select>
                        <div id="state_error" class="text-danger mt-1"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="div_input col-md-6">
                    <label for="">City</label><span class="text-danger"> *</span>
                    <input id="city" name="city" class="  form-control" type="text" required>
                    <div id="city_error" class="text-danger mt-1"></div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">Postal Code</label><span class="text-danger"> *</span>
                    <input id="postal_code" name="postal_code" class="  form-control" type="number">
                    <div id="code_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="row">
                <div class="div_input col-md-6">
                    <label for="">Address</label><span class="text-danger"> *</span>
                    <input id="address" name="address" class="  form-control" type="text" required>
                    <div id="address_error" class="text-danger mt-1"></div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">Gender</label><span class="text-danger"> *</span><br>
                    <div class="d-flex flex-column">
                        <select id="gender" name="gender" class="select custom-select" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <div id="gender_error" class="text-danger mt-1"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="div_input col-md-6">
                    <label for="password">Password</label><span class="text-danger"> *</span>
                    <div class="position-relative">
                        <input id="password" name="password" class="form-control" type="password"
                            required autocomplete="new-password"
                            aria-describedby="pwd-checklist-region pass_error">

                        <span id="eyeToggle"
                            role="button" tabindex="0" aria-label="Toggle password visibility">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>

                        <div class="pwd-checklist" id="pwdChecklist"
                            role="status" aria-live="polite" id="pwd-checklist-region">
                            <div class="pwd-item" data-rule="length">
                                <span class="pwd-icon"><i class="fa fa-square-o"></i></span>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="pwd-item" data-rule="upper">
                                <span class="pwd-icon"><i class="fa fa-square-o"></i></span>
                                <span>Contains one uppercase letter (A–Z)</span>
                            </div>
                            <div class="pwd-item" data-rule="lower">
                                <span class="pwd-icon"><i class="fa fa-square-o"></i></span>
                                <span>Contains one lowercase letter (a–z)</span>
                            </div>
                            <div class="pwd-item" data-rule="digit">
                                <span class="pwd-icon"><i class="fa fa-square-o"></i></span>
                                <span>Contains one number (0–9)</span>
                            </div>
                            <div class="pwd-item" data-rule="special">
                                <span class="pwd-icon"><i class="fa fa-square-o"></i></span>
                                <span>Contains one special character (@$!%*?&)</span>
                            </div>
                            <div class="pwd-all-met" id="pwdAllMet" aria-live="assertive">
                                <i class="fa fa-check-circle"></i> All requirements met!
                            </div>
                        </div>
                    </div>
                    <div id="pass_error" class="text-danger mt-1"></div>
                </div>
                <div class="div_input col-md-6">
                    <label for="">Confirm Password</label><span class="text-danger"> *</span>
                    <div class="position-relative">
                        <input id="con_password" name="con_password" class="form-control" type="password" required>
                        <span class="iconPassword">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div id="con_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="buttons">
                        <button type="submit" class="btn btn-dark flex-fill">Signup</button>
                        <a class="btn btn-danger flex-fill" href="./login.php">Back to Login</a>
                    </div>
                </div>
            </div>

        </form>
    </div>


    <?php
    include "./includes/footer.php"
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

            $('.iconPassword').click(function() {

                let password = $('#con_password');
                let icon = $(this).find('i');

                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    password.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }

            });


            $('#f_name').on('input', function() {
                let input = this;
                let start = input.selectionStart;
                let end = input.selectionEnd;

                let value = input.value;

                let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

                input.value = capitalized;

                input.setSelectionRange(start, end);
            });


            $('#last_name').on('input', function() {
                let input = this;
                let start = input.selectionStart;
                let end = input.selectionEnd;

                let value = input.value;

                let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

                input.value = capitalized;

                input.setSelectionRange(start, end);
            });

            function validateFName() {
                let f_name = $('#f_name').val().trim();
                let error = '';

                if (f_name == "") {
                    error = "Please Enter Name";
                } else if (f_name !== "") {
                    if (f_name.length < 3) {
                        error = "Too short";
                    } else if (!/^[a-zA-Z\s]+$/.test(f_name)) {
                        error = "Numbers and special letters not allowed";
                    }
                }

                $('#f_error').text(error);
                return error === '';
            }

            function validateLastName() {
                let name = $('#last_name').val().trim();
                let error = '';
                if (name == "") {
                    error = "Please Enter Name";
                } else if (name !== "") {
                    if (name.length < 3) {
                        error = "Too short";
                    } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                        error = "Numbers and special letters not allowed";
                    }
                }

                $('#last_error').text(error);
                return error === '';
            }

            $('#u_email').on('input', function() {
                let value = $(this).val().toLowerCase();
                $(this).val(value);
            });

            function validateEmail() {
                let email = $('#u_email').val().trim();
                let error = '';
                if (email == "") {
                    error = "Please Enter Email";
                } else if (email !== "") {
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        error = "Invalid Email";
                    }
                }
                $('#email_error').text(error);
                return error === '';
            }

            function validatePhone() {
                let phone = $('#p_number').val().trim();
                let error = '';
                if (phone == "") {
                    error = "Please Enter Phone";
                } else if (phone !== "") {
                    if (!/^(\+92|0)?3[0-9]{9}$/.test(phone)) {
                        error = "Invalid phone number";
                    }
                }

                $('#number_error').text(error);
                return error === '';
            }

            function validateCountry() {
                let country = $('#country').val().trim();
                let error = '';

                if (country == '') {
                    error = "Please Select Country Name";
                }

                $('#country_error').text(error);
                return error === '';
            }

            function validateState() {
                let state = $('#state').val().trim();
                let error = '';

                if (state == '') {
                    error = "Please Select State Name";
                }

                $('#state_error').text(error);
                return error === '';
            }

            function validateCity() {
                let city = $('#city').val().trim();
                let error = '';

                if (city == "") {
                    error = "Please Enter City";
                } else if (city !== "") {
                    if (city.length < 3) {
                        error = "Too short";
                    } else if (!/^[a-zA-Z\s]+$/.test(city)) {
                        error = "Numbers and special letters not allowed";
                    }
                }

                $('#city_error').text(error);
                return error === '';
            }

            function validateCode() {
                let p_code = $('#postal_code').val().trim();
                let error = "";

                if (!p_code == "") {
                    if (p_code.length < 3) {
                        error = "Too short";
                    } else if (!/^[a-zA-Z0-9_-]+$/.test(p_code)) {
                        error = "Spaces and special characters not allowed";
                    }
                }
                $('#code_error').text(error);
                return error === "";
            }

            function validateAddress() {
                let address = $("#address").val().trim();
                let error = "";

                if (address == "") {
                    error = "Please Enter Address";
                } else if (address !== "") {
                    let wordCount = address.split(/\s+/).length;

                    if (wordCount < 3) {
                        error = "Address must be at least 3 words";
                    }
                }

                $("#address_error").text(error);
                return error === "";
            }

            function validateGender() {
                let gender = $('#gender').val().trim();
                let error = '';

                if (gender == '') {
                    error = "Please Select Gender";
                }

                $('#gender_error').text(error);
                return error === '';
            }

            /* ── per-rule testers ── */
            const pwdRules = {
                length: v => v.length >= 8,
                upper: v => /[A-Z]/.test(v),
                lower: v => /[a-z]/.test(v),
                digit: v => /\d/.test(v),
                special: v => /[@$!%*?&]/.test(v)
            };

            function updatePwdChecklist(val) {
                let allMet = true;
                $('.pwd-item').each(function() {
                    const rule = $(this).data('rule');
                    const ok = pwdRules[rule](val);
                    if (!ok) allMet = false;
                    const icon = $(this).find('.pwd-icon i');
                    if (ok) {
                        $(this).addClass('met');
                        icon.removeClass('fa-square-o').addClass('fa-check-square');
                    } else {
                        $(this).removeClass('met');
                        icon.removeClass('fa-check-square').addClass('fa-square-o');
                    }
                });
                allMet ? $('#pwdAllMet').addClass('show') : $('#pwdAllMet').removeClass('show');
            }

            /* ── dropdown show/hide ── */
            let pwdHoveringDropdown = false;

            $('#password').on('focus', function() {
                updatePwdChecklist($(this).val());
                $('#pwdChecklist').addClass('visible');
                $('#pass_error').text('');
            });

            $('#pwdChecklist')
                .on('mouseenter', function() {
                    pwdHoveringDropdown = true;
                })
                .on('mouseleave', function() {
                    pwdHoveringDropdown = false;
                });

            $('#password').on('blur', function() {
                setTimeout(function() {
                    if (!pwdHoveringDropdown) {
                        $('#pwdChecklist').removeClass('visible');
                        validatePassword(); // now runs AFTER clearing stops
                    }
                }, 120);
            });

            $('#password').on('input', function() {
                updatePwdChecklist($(this).val());
                $('#pass_error').text(''); // don't validate mid-typing
            });

            /* ── eye toggle ── */
            $('#eyeToggle').on('click keydown', function(e) {
                if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') return;
                const inp = $('#password');
                const isPass = inp.attr('type') === 'password';
                inp.attr('type', isPass ? 'text' : 'password');
                $('#eyeIcon').toggleClass('fa-eye fa-eye-slash');
                $(this).attr('aria-label', isPass ? 'Hide password' : 'Show password');
            });

            function validatePassword() {
                let pass = $('#password').val().trim();
                let error = '';
                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (pass == '') {
                    error = "Please Enter Password";
                } else if (!regex.test(pass)) {
                    error = "Please Enter Valid Password";
                }

                $('#pass_error').text(error);

                return error === '';
            }

            function confirmPassword() {
                let pass = $('#password').val().trim();
                let con_pass = $('#con_password').val().trim();
                let error = '';

                if (con_pass == '') {
                    error = "Please Confirm Password";
                } else if (pass !== con_pass) {
                    error = "Password Not Matched";
                }

                $('#con_error').text(error);
                return error === '';
            }

            $('#f_name').on('input', validateFName);
            $('#last_name').on('input', validateLastName);
            $('#u_email').on('input', validateEmail);
            $('#p_number').on('input', validatePhone);
            $('#country').on('change', validateCountry);
            $('#state').on('change', validateState);
            $('#city').on('input', validateCity);
            $('#postal_code').on('input', validateCode);
            $('#address').on('input', validateAddress);
            $('#gender').on('change', validateGender);
            $('#con_password').on('input', confirmPassword);

            $('#signup_form').on('submit', function(e) {
                $('.btn').blur();

                let validFName = validateFName();
                let validLastName = validateLastName();
                let validEmail = validateEmail();
                let validPhone = validatePhone();
                let validCountry = validateCountry();
                let validState = validateState();
                let validCity = validateCity();
                let validCode = validateCode();
                let validAddress = validateAddress();
                let validGender = validateGender();
                let validPassword = validatePassword();
                let validCon = confirmPassword();

                if (!validFName || !validLastName || !validEmail || !validPhone || !validCountry || !validState || !validCity || !validCode || !validAddress || !validGender || !validPassword || !validCon) {
                    e.preventDefault();
                }
            })

        })
    </script>