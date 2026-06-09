<?php
include "./sql/conn.php";
include "./includes/header.php";
?>

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13596.390152840306!2d73.468894942051!3d31.576373017855335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39189e305101b5c3%3A0x53fe21a3882b0c0d!2sShahkot%2C%20Pakistan!5e0!3m2!1sen!2s!4v1778818625965!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Office</h4>
                            <p>Nankana Road Near Tariq Mart,Shahkot<br />+92 323 6745234</p>
                        </li>
                        <li>
                            <h4>Postal Address</h4>
                            <p>College Road Opposite To Gymnasium,Shahkot<br />042-57443434</p>
                        </li>
                    </ul>
                </div>
            </div>

            <?php
            $email = $_SESSION['user_email'];
            $query = "SELECT `last_name` From `user` WHERE `u_email`='$email'";
            $sql = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($sql);
            ?>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="./handlers/contact.php" method="POST" id="contactForm">
                        <div class="row">
                            <div class="col-lg-6">
                                <input name="last_name" class="form-control text-dark" type="text" placeholder="Name" value="<?php echo $row['last_name'] ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <input name="u_email" class="form-control text-dark" type="text" placeholder="Email" value="<?php echo $email ?>" readonly>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex flex-column mb-3">
                                    <textarea name="msg" id="msg" class="form-control mb-1 text-dark" placeholder="Message"></textarea>
                                    <small id="msg_error" class="text-danger"></small>
                                </div>
                                <button type="submit" class="btn site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php
include "./includes/footer.php";
?>

<script>
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

    // Message validation
    function validateMessage() {

        let msg = $('#msg').val().trim();
        let error = '';

        let words = msg.split(/\s+/).filter(word => word.length > 0);

        if (msg == '') {

            error = "Please Enter Message";

        } else if (!/^[A-Za-z]/.test(msg)) {

            error = "Message cannot start with numbers or special characters";

        } else if (words.length < 3) {

            error = "Message must contain at least 3 words";
        }

        $('#msg_error').text(error);
        return error === '';
    }

    // Real-time validation
    $('#msg').on('input', validateMessage);

    // Form submit validation
    $('#contact_form').on('submit', function(e) {
        $('.btn').blur();
        let validMessage = validateMessage();

        if (!validMessage) {

            e.preventDefault();
        }
    });
</script>