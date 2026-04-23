<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";

?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row  justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <!-- heading -->
                        <div class="card-header d-flex justify-content-between">
                            <h4>Add User</h4>
                            <a href="./user_table.php" class="btn btn-primary">Users</a>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="user_form" action="" method="POST">
                            <div class="card-body">
                                <!-- input to edit -->
                                <input type="hidden" name='edit_index' value="">
                                <!-- input to edit -->

                                <!-- User name -->
                                <div class="">
                                    <label>User Name </label><span> *</span>
                                    <input name="user_name" type="text" id="user_name" class="form-control" value="" required>
                                </div>
                                <div id="user_error" class="text-danger mt-1"></div>
                                <!-- User name -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label>Email </label><span> *</span>
                                    <input id="user_email" type="email" name="user_email" class="form-control" value="" required>
                                </div>
                                <div id="email_error" class="text-danger mt-1"></div>
                                <!-- email -->

                                <!-- password -->
                                <div class="mt-4">
                                    <label for="">Password </label> <span> *</span>
                                    <input id="user_pass" type="password" class="form-control" name="user_pass" required>

                                </div>
                                <div id="pass_error" class="text-danger mt-1"></div>
                                <!-- password -->

                                <!-- Role -->
                                <div class="mt-4">
                                    <label>Role </label><span> *</span>
                                    <select id="role_name" name="role_id" class="form-control">
                                        <option value="">Select Role</option>

                                    </select>
                                </div>
                                <!-- role -->


                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button id="cat_submit" class="btn btn-primary mr-1" type="submit">Add</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
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

        $('#user_name').on('input', function() {
            let input = this;
            let start = input.selectionStart;
            let end = input.selectionEnd;

            let value = input.value;

            let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

            input.value = capitalized;

            input.setSelectionRange(start, end);
        });

        $('#user_email').on('input', function() {
            let value = $(this).val().toLowerCase();
            $(this).val(value);
        });

        function validateName() {
            let name = $('#user_name').val().trim();
            let error = '';
            if (name !== "") {
                if (name.length < 3) {
                    error = "Too short";
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    error = "Numbers and special characters not allowed";
                }
                $('#user_error').text(error);
                return error === "";
            }
        }

        function validateEmail() {
            let email = $('#user_email').val().trim();
            let error = '';

            if (email !== "") {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    error = "Invalid Email";
                }
            }
            $('#email_error').text(error);
            return error === '';
        }

        function validatePassword() {
            let password = $('#user_pass').val().trim();
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

        $('#user_name').on('input', validateName);
        $('#user_email').on('input', validateEmail);
        $('#user_pass').on('input', validatePassword);

        $("#user_form").on('submit', function(e) {
            let validName = validateName();
            let validEmail = validateEmail();
            let passValid = validatePassword();

            if (!validName || !validEmail || !passValid) {
                e.preventDefault();
            }
        })
    })
</script>