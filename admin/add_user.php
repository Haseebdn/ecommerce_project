<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row  justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <!-- heading -->
                        <div class="card-header d-flex justify-content-between">
                            <h4>Add User</h4>
                            <a href="./register_users.php" class="btn btn-primary">Users</a>
                        </div>
                        <!-- heading -->

                        <!-- form -->
                        <form id="add_form" action="./handlers/customer/insert_user.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <!-- first name -->
                                <div>
                                    <label for="f_name">First Name</label><span class="text-danger"> *</span>
                                    <input class="form-control" name="f_name" id="f_name" type="text" required>
                                    <div id="f_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- first name -->

                                <!-- last name -->
                                <div class="mt-4">
                                    <label for="">Last Name</label><span class="text-danger"> *</span>
                                    <input class="form-control" id="last_name" name="last_name" type="text" required>
                                    <div id="last_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- last name -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label for="">Email</label><span class="text-danger"> *</span>
                                    <input class="form-control" id="u_email" name="u_email" type="email" required>
                                    <div id="email_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- email -->

                                <!-- phone number -->
                                <div class="mt-4">
                                    <label for="">Phone No.</label><span class="text-danger"> *</span>
                                    <input class="form-control" id="p_number" name="p_number" type="tel" required>
                                    <div id="number_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- phone number -->

                                <!-- country -->
                                <div class="mt-4">
                                    <label for="">Country</label><span class="text-danger"> *</span><br>
                                    <select id="country" name="country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        <option value="Pakistan">Pakistan</option>
                                    </select>
                                    <div id="country_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- country -->

                                <!-- state -->
                                <div class="mt-4">
                                    <label for="">State</label><span class="text-danger"> *</span><br>
                                    <select id="state" name="state" class="form-control" required>
                                        <option value="">Select State</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="KPK">KPK</option>
                                        <option value="Balochistan">Balochistan</option>
                                        <option value="Sindh">Sindh</option>
                                    </select>
                                    <div id="state_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- state -->

                                <!-- city -->
                                <div class="mt-4">
                                    <label for="">City</label><span class="text-danger"> *</span>
                                    <input id="city" name="city" class="form-control" type="text" required>
                                    <div id="city_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- city -->

                                <!-- postal code -->
                                <div class="mt-4">
                                    <label for="">Postal Code</label><span class="text-danger"> *</span>
                                    <input id="postal_code" name="postal_code" class="form-control" type="text" required>
                                    <div id="code_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- postal code -->

                                <!-- address -->
                                <div class="mt-4">
                                    <label for="">Address</label><span class="text-danger"> *</span>
                                    <input id="address" name="address" class="form-control" type="text" required>
                                    <div id="address_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- address -->

                                <!-- profile pic -->
                                <label class="mt-4">Profile Picture</label><span class="text-danger"> *</span>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="p_pic" name="p_pic">
                                    <label class="custom-file-label" for="p_pic">Choose file</label>
                                </div>
                                <!-- profile pic -->

                                <!-- gender -->
                                <div class="mt-4">
                                    <label for="">Gender</label><span class="text-danger"> *</span><br>
                                    <select id="gender" name="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div id="gender_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- gender -->

                                <!-- password -->
                                <div class="mt-4">
                                    <label for="">Password</label><span class="text-danger"> *</span>
                                    <input id="password" name="password" class="form-control" type="password" required>
                                    <div id="pass_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- password -->

                                <!-- confirm password -->
                                <div class="mt-4">
                                    <label for="">Confirm Password</label><span class="text-danger"> *</span>
                                    <input id="con_password" name="con_password" class="form-control" type="password" required>
                                    <div id="con_error" class="text-danger mt-1"></div>
                                </div>
                                <!-- confirm password -->
                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button id="user_submit" class="btn btn-primary mr-1" type="submit">Add</button>
                                <a class="btn btn-secondary" href="./register_users.php">Cancel</a>
                            </div>
                            <!-- buttons -->
                        </form>
                        <!-- form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include "./include/footer.php";
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
            return error === "";
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

        $('#add_form').on('submit', function(e) {
        
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