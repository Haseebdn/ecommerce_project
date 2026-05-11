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
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
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
                                <a href="#">Admin</a>
                                <a href="../profile.php">My Account</a>
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
                        <a href="./index.php"><img src="img/logo.png" alt="" class="w-75"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./checkout.php">Check Out</a></li>
                            <li><a href="./contact.php">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="../shopping_cart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">0.00<span> PKR</span></div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <div class="container mt-5">
        <h2 class="px-5">Signup</h2>
        <form id="signup_form" action="./handlers/signup.php" method="POST" class=" my-5 px-5" enctype="multipart/form-data">
            <div class="d-flex justify-content-between">
                <div class="w-50">
                    <label for="">First Name</label><span class="text-danger"> *</span>
                    <input class=" w-75 form-control" name="f_name" id="f_name" type="text" required>
                    <div id="f_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">Last Name</label><span class="text-danger"> *</span>
                    <input class=" w-75 form-control" id="last_name" name="last_name" type="text" required>
                    <div id="last_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">Email</label><span class="text-danger"> *</span>
                    <input class=" w-75 form-control" id="u_email" name="u_email" type="email" required>
                    <div id="email_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">Phone No.</label><span class="text-danger"> *</span>
                    <input class=" w-75 form-control" id="p_number" name="p_number" type="tel" required>
                    <div id="number_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">Country</label><span class="text-danger"> *</span><br>
                    <select id="country" name="country" class="w-75 custom-select" required>
                        <option value="">Select Country</option>
                        <option value="Pakistan">Pakistan</option>
                    </select>
                    <div id="country_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">State</label><span class="text-danger"> *</span><br>
                    <select id="state" name="state" class="w-75 custom-select" required>
                        <option value="">Select State</option>
                        <option value="Punjab">Punjab</option>
                        <option value="KPK">KPK</option>
                        <option value="Balochistan">Balochistan</option>
                        <option value="Sindh">Sindh</option>
                    </select>
                    <div id="state_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">City</label><span class="text-danger"> *</span>
                    <input id="city" name="city" class=" w-75 form-control" type="text" required>
                    <div id="city_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">Postal Code</label><span class="text-danger"> *</span>
                    <input id="postal_code" name="postal_code" class=" w-75 form-control" type="text" required>
                    <div id="code_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">Address</label><span class="text-danger"> *</span>
                    <input id="address" name="address" class=" w-75 form-control" type="text" required>
                    <div id="address_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">Profile Picture</label><span class="text-danger"> *</span>
                    <input id="p_pic" name="p_pic" class=" w-75 form-control" type="file">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">Gender</label><span class="text-danger"> *</span><br>
                    <select id="gender" name="gender" class="w-75 custom-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    <div id="gender_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <label for="">Password</label><span class="text-danger"> *</span>
                    <input id="password" name="password" class=" w-75 form-control" type="password" required>
                    <div id="pass_error" class="text-danger mt-1"></div>
                </div>
                <div class="w-50">
                    <label for="">Confirm Password</label><span class="text-danger"> *</span>
                    <input id="con_password" name="con_password" class=" w-75 form-control" type="password" required>
                    <div id="con_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="w-50">
                    <button type="submit" class="btn btn-dark w-50">Signup</button>
                </div>
                <div class="w-50">
                    <a class="btn btn-danger w-50" href="./login.php">Back to Login</a>
                </div>
            </div>

        </form>
    </div>


    <?php
    include "./includes/footer.php"
    ?>

    <script>
        $(document).ready(function() {
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

                if (f_name !== "") {
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

                if (name !== "") {
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

                if (email !== "") {
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

                if (phone !== "") {
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

                if (city !== "") {
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
            }

            function validateAddress() {
                let address = $("#address").val().trim();
                let error = "";

                if (address !== "") {
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
                    error = "Please Enter State Name";
                }

                $('#gender_error').text(error);
                return error === '';
            }

            function validatePassword() {
                let password = $('#password').val().trim();
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

            function confirmPassword() {
                let pass = $('#password').val().trim();
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

            $('#f_name').on('input', validateFName);
            $('#last_name').on('input', validateLastName);
            $('#u_email').on('input', validateEmail);
            $('#p_number').on('input', validatePhone);
            $('#country').on('input', validateCountry);
            $('#state').on('input', validateState);
            $('#city').on('input', validateCity);
            $('#postal_code').on('input', validateCode);
            $('#address').on('input', validateAddress);
            $('#gender').on('input', validateGender);
            $('#password').on('input', validatePassword);
            $('#con_pass').on('input', confirmPassword);

            $('#signup_form').on('submit', function(e) {
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

                if (!validFName || !validLastName || !validEmail || !validPhone || !validCountry || !validState || !validCity || !validCode || !validAddress || !validGender || !validPassword || !confirmPassword) {
                    e.preventDefault();
                }
            })

        })
    </script>