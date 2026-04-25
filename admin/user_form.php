<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";

if (isset($_GET) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `admin` WHERE `id`=$id";
    $sql = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($sql);
}

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
                            <h4><?php echo isset($_GET['id']) ? 'Update User' : 'Add User'   ?></h4>
                            <a href="./user_table.php" class="btn btn-primary">Users</a>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="user_form" action="<?php echo isset($_GET['id']) ? './handlers/adm_user/update.php' : './handlers/adm_user/add.php' ?>" method="POST">
                            <div class="card-body">
                                <!-- input to edit -->
                                <input type="hidden" name='edit_index' value="<?php echo $_GET['id'] ?? '' ?>">
                                <!-- input to edit -->

                                <!-- User name -->
                                <div class="">
                                    <label>User Name</label><span class="text-danger ml-1">*</span>
                                    <input name="user_name" type="text" id="user_name" class="form-control" value="<?php echo isset($record['adm_name']) ? $record['adm_name'] : '' ?>" required>
                                </div>
                                <div id="user_error" class="text-danger mt-1"></div>
                                <!-- User name -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label>Email</label><span class="text-danger ml-1">*</span>
                                    <input id="user_email" type="email" name="user_email" class="form-control" value="<?php echo isset($record['adm_email']) ? $record['adm_email'] : '' ?>" required>
                                </div>
                                <div id="email_error" class="text-danger mt-1"></div>
                                <!-- email -->

                                <!-- password -->
                                <div class="mt-4">
                                    <label for="">Password</label> <span class="text-danger ml-1">*</span>
                                    <input id="user_pass" type="password" class="form-control" name="user_pass" value="<?php echo isset($record['adm_pass']) ? $record['adm_pass'] : '' ?>" required>

                                </div>
                                <div id="pass_error" class="text-danger mt-1"></div>
                                <!-- password -->

                                <!-- confirm password -->
                                <div class="mt-4">
                                    <label for="">Confirm Password</label><span class="text-danger ml-1">*</span>
                                    <input id="con_pass" type="password" class="form-control" name="con_pass" value="<?php echo isset($record['adm_pass']) ? $record['adm_pass'] : '' ?>" required>

                                </div>
                                <div id="con_error" class="text-danger mt-1"></div>
                                <!-- confirm password -->

                                <!-- Role -->
                                <div class="mt-4">
                                    <label>Role</label><span class="text-danger ml-1">*</span>
                                    <select id="role_name" name="role_id" class="form-control">
                                        <option value="">Select Role</option>
                                        <?php
                                        $query = "SELECT * FROM `admin_role`";
                                        $sql = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['id'] ?>" <?php echo (isset($record['adm_role']) && $record['adm_role'] == $row['id']) ? 'selected' : '' ?>><?php echo $row['role_name']    ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <!-- role -->


                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button id="cat_submit" class="btn btn-primary mr-1" type="submit"><?php echo isset($_GET['id']) ? 'Update' : 'Add'    ?></button>
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

        function confirmPassword() {
            let pass = $('#user_pass').val().trim();
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

        $('#user_name').on('input', validateName);
        $('#user_email').on('input', validateEmail);
        $('#user_pass').on('input', validatePassword);
        $('#con_pass').on('input', confirmPassword);

        $("#user_form").on('submit', function(e) {
            let validName = validateName();
            let validEmail = validateEmail();
            let passValid = validatePassword();
            let conValid = confirmPassword();
            if (!validName || !validEmail || !passValid || !conValid) {
                e.preventDefault();
            }
        })
    })
</script>