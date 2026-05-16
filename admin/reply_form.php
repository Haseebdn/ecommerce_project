<?php
include "sql/conn.php";
include "include/header.php";
include "include/sidebar.php";
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
                        <form id="reply_form" action="" method="POST">
                            <div class="card-body">

                                <!-- name -->
                                <div class="">
                                    <label>To</label><span class="text-danger ml-1">*</span>
                                    <input type="text" id="customer_name" name="customer_name" class="form-control" value="" required>
                                </div>
                                <div id="name_error" class="text-danger mt-1"></div>
                                <!-- name -->

                                <!-- email -->
                                <div class="mt-4">
                                    <label>Email</label><span class="text-danger ml-1">*</span>
                                    <input id="customer_email" type="email" name="customer_email" class="form-control" value="" required>
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