<?php
include "./sql/conn.php";
include "./includes/header.php";
?>
<link rel="stylesheet" href="css/media_queries/signup.css">

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Update Profile</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Edit Profile</span>
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

<div class="container mt-5">
    <h2>Edit Profile</h2>
    <form id="edit_form" action="./handlers/edit_profile.php" method="POST">
        <div class="row">
            <div class="div_input col-md-6">
                <label for="">First Name</label><span class="text-danger"> *</span>
                <input class="form-control" name="f_name" id="f_name" type="text" value="<?php echo $row['f_name'] ?>" required>
                <div id="f_error" class="text-danger mt-1"></div>
            </div>
            <div class="div_input col-md-6">
                <label for="">Last Name</label><span class="text-danger"> *</span>
                <input class="form-control" id="last_name" name="last_name" type="text" value="<?php echo $row['last_name'] ?>" required>
                <div id="last_error" class="text-danger mt-1"></div>
            </div>
        </div>
        <div class="row">
            <div class="div_input col-md-6">
                <label for="">Email</label><span class="text-danger"> *</span>
                <input class="  form-control" id="u_email" name="u_email" type="email" value="<?php echo $row['u_email'] ?>" required readonly>
                <div id="email_error" class="text-danger mt-1"></div>
            </div>
            <div class="div_input col-md-6">
                <label for="">Phone No.</label><span class="text-danger"> *</span>
                <input class="  form-control" id="p_number" name="p_number" type="tel" value="<?php echo $row['p_number'] ?>" required>
                <div id="number_error" class="text-danger mt-1"></div>
            </div>
        </div>
        <div class="row">
            <div class="div_input col-md-6">
                <label for="">Country</label><span class="text-danger"> *</span><br>
                <div class="d-flex flex-column">
                    <select id="country" name="country" class="select custom-select" required>
                        <option value="">Select Country</option>

                        <option value="Pakistan"
                            <?php echo ($row['country'] == 'Pakistan') ? 'selected' : '' ?>>
                            Pakistan
                        </option>
                    </select>
                    <div id="country_error" class="text-danger mt-1"></div>
                </div>
            </div>
            <div class="div_input col-md-6">
                <label for="">State</label><span class="text-danger"> *</span><br>
                <div class="d-flex flex-column">
                    <select id="state" name="state" class=" select custom-select" required>
                        <option value="">Select State</option>

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
        </div>
        <div class="row">
            <div class="div_input col-md-6">
                <label for="">City</label><span class="text-danger"> *</span>
                <input id="city" name="city" class="  form-control" type="text" value="<?php echo $row['city'] ?>" required>
                <div id="city_error" class="text-danger mt-1"></div>
            </div>
            <div class="div_input col-md-6">
                <label for="">Postal Code</label><span class="text-danger"> *</span>
                <input id="postal_code" name="postal_code" class="  form-control" type="text" value="<?php echo $row['postal_code'] ?>">
                <div id="code_error" class="text-danger mt-1"></div>
            </div>
        </div>
        <div class="row">
            <div class="div_input col-md-6">
                <label for="">Address</label><span class="text-danger"> *</span>
                <input id="address" name="address" class="  form-control" type="text" value="<?php echo $row['address'] ?>" required>
                <div id="address_error" class="text-danger mt-1"></div>
            </div>
            <div class="div_input col-md-6">
                <label for="">Gender</label><span class="text-danger"> *</span><br>
                <div class="d-flex flex-column">
                    <select id="gender" name="gender" class="select custom-select" required>
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
                    <div id="gender_error" class="text-danger mt-1"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="buttons">
                    <button type="submit" class="btn btn-dark flex-fill">Update Profile</button>

                    <a class="btn btn-danger flex-fill" href="./profile.php">Cancel</a>

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
                position: "top-end",
                icon: "success",
                title: "<?php echo $_SESSION['success']; ?>",
                showConfirmButton: false,
                timer: 2000
            });

            <?php unset($_SESSION['success']); ?>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "<?php echo $_SESSION['error']; ?>",
                showConfirmButton: false,
                timer: 2000
            });
            <?php unset($_SESSION['error']); ?>
        <?php } ?>

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
            if (p_code !== "") {
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

        $('#edit_form').on('submit', function(e) {
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


            if (!validFName || !validLastName || !validEmail || !validPhone || !validCountry || !validState || !validCity || !validCode || !validAddress || !validGender) {
                e.preventDefault();
            }
        })

    })
</script>