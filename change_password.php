<?php
include "./sql/conn.php";
if (!isset($_SESSION['user_email'])) {
    $_SESSION['error'] = "Please Login First";
    header("Location: login.php");
    exit();
}
include "./includes/header.php";
?>
<link rel="stylesheet" href="css/change_pass.css">
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Change Password</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow-sm p-4" style="width:100%; max-width:435px;">
        <h2 class="mb-4">Change Password</h2>

        <form id="pass_form" method="POST" action="./handlers/change_password.php">

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input id="email" class="form-control" type="email" name="email"
                    value="<?php echo $_SESSION['user_email'] ?>" readonly>
                <div id="email_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Old Password</label>
                <div class="password-wrapper">
                    <input id="old_pass" class="form-control" type="password" name="old_pass">
                    <i class="fa fa-eye toggle-password" data-target="old_pass"></i>
                </div>
                <div id="old_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <div class="pw-wrapper">
                    <div class="password-wrapper">
                        <input id="new_pass" class="form-control" type="password" name="new_pass"
                            autocomplete="new-password" aria-describedby="pw-checklist">
                        <i class="fa fa-eye toggle-password" data-target="new_pass"></i>
                    </div>

                    <div class="pw-dropdown" id="pw-checklist" role="status" aria-live="polite">
                        <div class="pw-rule" id="r-len">
                            <span class="rule-icon"><i class="fa fa-square-o"></i></span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="pw-rule" id="r-upper">
                            <span class="rule-icon"><i class="fa fa-square-o"></i></span>
                            <span>Contains one uppercase letter (A–Z)</span>
                        </div>
                        <div class="pw-rule" id="r-lower">
                            <span class="rule-icon"><i class="fa fa-square-o"></i></span>
                            <span>Contains one lowercase letter (a–z)</span>
                        </div>
                        <div class="pw-rule" id="r-num">
                            <span class="rule-icon"><i class="fa fa-square-o"></i></span>
                            <span>Contains one number (0–9)</span>
                        </div>
                        <div class="pw-rule" id="r-special">
                            <span class="rule-icon"><i class="fa fa-square-o"></i></span>
                            <span>Contains one special character (@$!%*?&amp;)</span>
                        </div>
                        <div class="pw-all-ok" id="pw-all-ok">&#10003; Password meets all requirements</div>
                    </div>
                </div>
                <div id="new_error" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <div class="password-wrapper">
                    <input id="con_pass" class="form-control" type="password" name="con_pass">
                    <i class="fa fa-eye toggle-password" data-target="con_pass"></i>
                </div>
                <div id="con_error" class="text-danger mt-1"></div>
            </div>

            <div class="d-flex pb-2 mt-4 mb-1">
                <button type="submit" class="mr-3 btn btn-dark flex-fill">
                    Change Password
                </button>
                <a class="btn btn-danger flex-fill" href="./profile.php">
                    Cancel
                </a>
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

        $('.toggle-password').on('click', function() {

            let input = $('#' + $(this).data('target'));

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }

        });


        // Live checklist for new_pass — validateNewPassword() is untouched
        (function() {
            var input = $('#new_pass');
            var dropdown = $('#pw-checklist');
            var allOk = $('#pw-all-ok');
            var overDropdown = false;

            var rules = [{
                    id: 'r-len',
                    test: function(v) {
                        return v.length >= 8;
                    }
                },
                {
                    id: 'r-upper',
                    test: function(v) {
                        return /[A-Z]/.test(v);
                    }
                },
                {
                    id: 'r-lower',
                    test: function(v) {
                        return /[a-z]/.test(v);
                    }
                },
                {
                    id: 'r-num',
                    test: function(v) {
                        return /\d/.test(v);
                    }
                },
                {
                    id: 'r-special',
                    test: function(v) {
                        return /[@$!%*?&]/.test(v);
                    }
                }
            ];

            function updateRules(val) {
                var allPassed = true;
                $.each(rules, function(i, r) {
                    var el = $('#' + r.id);
                    var icon = el.find('.rule-icon i');
                    var passed = r.test(val);
                    if (!passed) allPassed = false;
                    if (passed) {
                        el.addClass('ok');
                        icon.attr('class', 'fa fa-check-square-o');
                    } else {
                        el.removeClass('ok');
                        icon.attr('class', 'fa fa-square-o');
                    }
                });
                if (allPassed && val.length > 0) allOk.addClass('show');
                else allOk.removeClass('show');
            }

            function showDrop() {
                dropdown.addClass('show');
                setTimeout(function() {
                    dropdown.addClass('visible');
                }, 10);
            }

            function hideDrop() {
                dropdown.removeClass('visible');
                setTimeout(function() {
                    if (!overDropdown && document.activeElement !== input[0]) {
                        dropdown.removeClass('show');
                    }
                }, 180);
            }

            dropdown.on('mouseenter', function() {
                overDropdown = true;
            });
            dropdown.on('mouseleave', function() {
                overDropdown = false;
                hideDrop();
            });

            input.on('focus', showDrop);
            input.on('blur', hideDrop);

            input.on('input', function() {
                updateRules($(this).val());
                $('#new_error').text(''); // suppress error text while typing
            });
        })();



        function validateOldPassword() {
            let password = $('#old_pass').val().trim();
            let error = '';

            if (password == "") {
                error = "Password is required";
            }

            $('#old_error').text(error);

            return error === '';
        }

        function validateNewPassword() {
            let password = $('#new_pass').val().trim();
            let error = '';


            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password == "") {
                error = "Password is required";
            } else if (!regex.test(password)) {
                error = "Min 8 chars, include upper, lower, number & special char";
            }

            $('#new_error').text(error);

            return error === '';
        }

        function confirmPassword() {
            let pass = $('#new_pass').val().trim();
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

        $('#old_pass').on('input', validateOldPassword);
        $('#new_pass').on('input', validateNewPassword);
        $('#con_pass').on('input', confirmPassword);

        $('#pass_form').on('submit', function(e) {
            $('.btn').blur();
            let validOldPass = validateOldPassword();
            let validNewPass = validateNewPassword();
            let validConPass = confirmPassword();

            if (!validOldPass || !validNewPass || !validConPass) {
                e.preventDefault();
            }


        });
    })
</script>