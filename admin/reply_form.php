<?php
include "sql/conn.php";
include "include/header.php";
include "include/sidebar.php";
$id = null;
if (isset($_GET) && !empty($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <!-- heading -->
                        <div class="card-header">
                            <h4>Reply</h4>
                        </div>
                        <!-- heading -->
                        <!-- form -->
                        <form id="reply_form" action="./handlers/contact/reply_mails.php" method="POST">

                            <?php
                            $query = "SELECT * FROM `contact_mails` WHERE `id`='$id'";
                            $sql = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($sql);
                            ?>
                            <div class="card-body">
                                <!-- name -->
                                <div class="">
                                    <label>To</label><span class="text-danger ml-1">*</span>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo isset($_GET['id']) ? $row['name'] : '' ?>" required>
                                </div>
                                <div id="name_error" class="text-danger mt-1"></div>
                                <!-- name -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label>Email</label><span class="text-danger ml-1">*</span>
                                    <input id="u_email" type="email" name="u_email" class="form-control" value="<?php echo isset($_GET['id']) ? $row['u_email'] : '' ?>" required>
                                </div>
                                <div id="email_error" class="text-danger mt-1"></div>
                                <!-- email -->

                                <!-- subject  -->
                                <div class="mt-4">
                                    <label>Subject</label><span class="text-danger ml-1">*</span>
                                    <input id="subject" type="text" name="subject" class="form-control" value="" required>
                                </div>
                                <div id="subject_error" class="text-danger mt-1"></div>
                                <!-- subject -->

                                <!-- body -->
                                <div class="mt-4">
                                    <label>Message</label><span class="text-danger ml-1">*</span>
                                    <textarea id="msg" type="text" name="msg" class="form-control" required></textarea>
                                </div>
                                <div id="msg_error" class="text-danger mt-1"></div>
                                <!-- body -->

                            </div>
                            <!-- buttons -->
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Reply</button>
                                <a href="./contact_table.php" class="btn btn-secondary" type="reset">Cancel</a>
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
include "include/footer.php";
?>
<script>
    $(document).ready(function() {

        $('#last_name').on('input', function() {
            let input = this;
            let start = input.selectionStart;
            let end = input.selectionEnd;

            let value = input.value;

            let capitalized = value.replace(/\b\w/g, c => c.toUpperCase());

            input.value = capitalized;

            input.setSelectionRange(start, end);
        });

        function validateName() {
            let name = $('#last_name').val().trim();
            let error = '';

            if (name == "") {
                error = "Enter receiver name";
            } else if (name !== "") {
                if (name.length < 3) {
                    error = "Too short";
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    error = "Numbers and special characters not allowed";
                }
                $('#name_error').text(error);
                return error === "";
            }
        }

        $('#u_email').on('input', function() {
            let value = $(this).val().toLowerCase();
            $(this).val(value);
        });

        function validateEmail() {
            let email = $('#u_email').val().trim();
            let error = '';

            if (email == "") {
                error = "Enter Email";
            } else if (email !== "") {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    error = "Invalid Email";
                }
            }
            $('#email_error').text(error);
            return error === '';
        }

        $('#subject').on('input', function() {
            let input = this;
            let start = input.selectionStart;
            let end = input.selectionEnd;

            let value = input.value.toLowerCase();

            let result = value.replace(/(^\s*\w|[.!?]\s*\w)/g, function(char) {
                return char.toUpperCase();
            });

            input.value = result;
            input.setSelectionRange(start, end);
        });


        function validateSubject() {
            let subject = $("#subject").val().trim();
            let error = "";

            if (subject == "") {
                error = "Enter email subject";
            }

            if (subject !== "") {
                let wordCount = subject.split(/\s+/).length;

                if (wordCount < 3) {
                    error = "Subject must be at least 3 words";
                }
            }

            $("#subject_error").text(error);
            return error === "";
        }

        $('#msg').on('input', function() {
            let input = this;
            let start = input.selectionStart;
            let end = input.selectionEnd;

            let value = input.value.toLowerCase();

            let result = value.replace(/(^\s*\w|[.!?]\s*\w)/g, function(char) {
                return char.toUpperCase();
            });

            input.value = result;
            input.setSelectionRange(start, end);
        });

        function validateMsg() {
            let msg = $("#msg").val().trim();
            let error = "";

            if (msg == "") {
                error = "Enter message";
            } else if (msg !== "") {
                let wordCount = msg.split(/\s+/).length;

                if (wordCount < 3) {
                    error = "Message must be atleast 3 words.";
                }
            }

            $("#msg_error").text(error);
            return error === "";
        }

        $('#last_name').on('input', validateName);
        $('#u_email').on('input', validateEmail);
        $('#subject').on('input', validateSubject);
        $('#msg').on('input', validateMsg);

        $('#reply_form').on('submit', function(e) {
            let nameValid = validateName();
            let emailValid = validateEmail();
            let subjectValid = validateSubject();
            let msgValid = validateMsg();

            if (!nameValid || !emailValid || !subjectValid || !msgValid) {
                e.preventDefault();
            }
        })
    });
</script>