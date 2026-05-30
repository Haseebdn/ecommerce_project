<?php
include "./sql/conn.php";
include "./includes/header.php";

$cart = null;
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<?php
$email = $_SESSION['user_email'];
$query = "SELECT * FROM `user` WHERE `u_email`='$email'";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
?>
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form id="checkout_form">
                <div class="row ">
                    <div class="col-lg-6 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row gap-5">
                            <div class="col-lg-6">
                                <div class="">
                                    <p>Fist Name<span>*</span></p>
                                    <input class=" w-100 form-control" name="f_name" id="f_name" type="text" value="<?php echo $row['f_name'] ?>" required>
                                    <div id="f_error" class="text-danger mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <p>Last Name<span>*</span></p>
                                    <input class=" w-100 form-control" id="last_name" name="last_name" type="text" value="<?php echo $row['last_name'] ?>" required>
                                    <div id="last_error" class="text-danger mt-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between my-4">
                            <div class="w-100">
                                <label for="">Country</label><span class="text-danger"> *</span><br>
                                <select id="country" name="country" class="w-100 " required>
                                    <option value="Pakistan"
                                        <?php echo ($row['country'] == 'Pakistan') ? 'selected' : '' ?>>
                                        Pakistan
                                    </option>
                                </select>
                                <div id="country_error" class="text-danger mt-1"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">

                            <div class="w-100">
                                <label for="">State</label><span class="text-danger"> *</span><br>
                                <select id="state" name="state" class="w-100 " required>
                                    <option value="Punjab"
                                        <?php echo ($row['state'] == 'Punjab') ? 'selected' : '' ?>>
                                        Punjab
                                    </option>

                                    <option value="KPK"
                                        <?php echo ($row['state'] == 'KPK') ? 'selected' : '' ?>>
                                        KPK
                                    </option>

                                    <option value="Balochistan"
                                        <?php echo ($row['state'] == 'Balochistan') ? 'selected' : '' ?>>
                                        Balochistan
                                    </option>

                                    <option value="Sindh"
                                        <?php echo ($row['state'] == 'Sindh') ? 'selected' : '' ?>>
                                        Sindh
                                    </option>
                                </select>
                                <div id="state_error" class="text-danger mt-1"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="w-100">
                                <label for="">City</label><span class="text-danger"> *</span>
                                <input id="city" name="city" class=" w-100 form-control" type="text" value="<?php echo $row['city'] ?>" required>
                                <div id="city_error" class="text-danger mt-1"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="w-100">
                                <label for="">Postal Code</label><span class="text-danger"> *</span>
                                <input id="postal_code" name="postal_code" class=" w-100 form-control" type="text" value="<?php echo $row['postal_code'] ?>" required>
                                <div id="code_error" class="text-danger mt-1"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="w-100">
                                <label for="">Address</label><span class="text-danger"> *</span>
                                <input id="address" name="address" class=" w-100 form-control" type="text" value="<?php echo $row['address'] ?>" required>
                                <div id="address_error" class="text-danger mt-1"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="w-100">
                                <label for="">Gender</label><span class="text-danger"> *</span><br>
                                <select id="gender" name="gender" class="w-100" required>

                                    <option value="">Select Gender</option>

                                    <option value="Male"
                                        <?php echo ($row['gender'] == 'Male') ? 'selected' : '' ?>>
                                        Male
                                    </option>

                                    <option value="Female"
                                        <?php echo ($row['gender'] == 'Female') ? 'selected' : '' ?>>
                                        Female
                                    </option>

                                    <option value="Others"
                                        <?php echo ($row['gender'] == 'Others') ? 'selected' : '' ?>>
                                        Others
                                    </option>

                                </select>
                                <div id="gender_error" class="text-danger mt-1 "></div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <p>Phone Number<span>*</span></p>
                                    <input class=" w-100 form-control" id="p_number" name="p_number" type="tel" value="<?php echo $row['p_number'] ?>" required>
                                    <div id="number_error" class="text-danger mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <p>Email<span>*</span></p>
                                    <input class=" w-100 form-control" id="u_email" name="u_email" type="email" value="<?php echo $row['u_email'] ?>" required readonly>
                                    <div id="email_error" class="text-danger mt-1"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order w-100">
                            <h4 class="order__title">Your order</h4>
                            <table class="w-100 ml-3">
                                <thead>
                                    <tr class="row w-100 border-bottom">
                                        <th class="col-4 text-center">Product</th>
                                        <th class="col-4 text-center">Qty</th>
                                        <th class="col-4 text-center">Price</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM `cart` WHERE `u_email`='$email'";
                                $wql = mysqli_query($conn, $query);
                                $cartCount = mysqli_num_rows($wql);
                                ?>
                                <tbody>
                                    <?php
                                    $g_total = null;
                                    while ($cart = mysqli_fetch_assoc($wql)) {
                                        $g_total += $cart['total_price'];
                                    ?>
                                        <tr class="row border-bottom py-2 w-100">
                                            <td class="col-4 text-center px-1"><?php echo $cart['p_name']     ?></td>
                                            <td class="col-4 text-center px-1"><?php echo $cart['qty']     ?></td>
                                            <td class="col-4 text-center px-1"><?php echo $cart['total_price']     ?> PKR</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="my-5 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span class="text-danger"><?php echo $g_total  ?> PKR</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Discount</span>
                                    <span class="text-danger">0.00 PKR</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Total</span>
                                    <span class="text-danger"><?php echo $g_total  ?> PKR</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-secondary">Please make transaction of required amount to purchase the above products </p>
                            </div>

                            <input class="mb-5" type="radio" name="payment" value="COD" checked> Cash On Delivery <br>
                            <button id="order" type="button" class="w-100 mb-3 btn btn-dark">Place Order</button>
                            <a href="./shopping_cart.php" class=" w-100 mb-3 btn btn-danger">Back to Cart</a>
                            <a href="./shop.php" class=" w-100 mb-3 btn btn-primary">Continue Shopping</a>

                        </div>

                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
</section>
<!-- Checkout Section End -->


<?php
include "./includes/footer.php";
?>

<script>
    $(document).ready(function() {
        $('#order').on('click', function(e) {

            e.preventDefault();

            let validCart = <?php echo ($cartCount > 0) ? 'true' : 'false'; ?>;

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

            if (!validFName || !validLastName || !validEmail ||
                !validPhone || !validCountry || !validState ||
                !validCity || !validCode || !validAddress || !validGender) {

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fix the highlighted fields.'
                });

                return;
            }

            if (!validCart) {

                Swal.fire({
                    icon: 'error',
                    title: 'Cart Empty',
                    text: 'Please add products to your cart before placing an order.'
                });

                return;
            }

            let form = document.querySelector('#checkout_form');
            let formData = new FormData(form);

            Swal.fire({
                title: "Place Order?",
                text: "Do you want to place this order?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Place Order"
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "./handlers/order.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(res) {

                        let response = JSON.parse(res);

                        if (response.status === "success") {

                            Swal.fire({
                                icon: "success",
                                title: "Order Placed",
                                text: response.message
                            }).then(() => {

                                window.location.href = "./thank_you.php";

                            });

                        } else {

                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.message
                            });

                        }
                    },

                    error: function() {

                        Swal.fire({
                            icon: "error",
                            title: "Server Error",
                            text: "Something went wrong."
                        });

                    }
                });

            });

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
                error = "Name is required";
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
                error = "Name is required";
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
            return error === '';
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





    })
</script>