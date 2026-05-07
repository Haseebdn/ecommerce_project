<?php
include "./sql/conn.php";
include "./includes/header.php";
?>

<link rel="stylesheet" href="./css/profile.css">
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>My Account</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div class="container my-5">
    <div class="row py-4">
        <div class="col col-md-3 p-4 d-flex flex-column align-items-center">
            <div class="img">
                <img class="p_pic" src="./img/default.jpg" alt="">
            </div>
            <a href="">Remove Profile Picture</a>
            <span class=" h5 mt-3 mb-0">Name</span>
            <span>@gmail.com</span>
        </div>

        <div class="col profile col-md-6  p-4">
            <h3>Profile Info</h3>
            <div class="name mt-4 d-flex justify-content-between ">
                <div id="f_name">
                    <h5 class="text-danger">First Name</h5>
                    <span class="h5">myna</span>
                </div>
                <div id="last_name">
                    <h5 class="text-danger">Last Name</h5>
                    <span class="h5">mfa</span>
                </div>
            </div>
            <div class="email mt-4">
                <h5 class="text-danger">Email</h5>
                <span class="h5">@gmail.com</span>
            </div>
            <div class="phone mt-4">
                <h5 class="text-danger">Phone Number</h5>
                <span class="h5">035353535</span>
            </div>
            <div class="country mt-4">
                <h5 class="text-danger">Country</h5>
                <span class="h5">Pakistan</span>
            </div>
            <div class="state mt-4">
                <h5 class="text-danger">State</h5>
                <span class="h5">Punjab</span>
            </div>
            <div class="city mt-4">
                <h5 class="text-danger">City</h5>
                <span class="h5">Shahkot</span>
            </div>
            <div class="postal_code mt-4">
                <h5 class="text-danger">Postal Code</h5>
                <span class="h5">36430</span>
            </div>
            <div class="address mt-4">
                <h5 class="text-danger">Address</h5>
                <span class="h5">Shahkot</span>
            </div>
        </div>

        <div class="col col-md-3 pt-4">
            <form method="POST" class="w-100 pt-5" action="./profile_edit.php">
                <input type="hidden" name="profile_edit" value="">
                <button type="submit" class="btn btn-dark w-100">Edit Profile Data</button>
            </form>
            <form class="w-100 pt-3 " action="./change_email.php">
                <input type="hidden" name="email_change" value="">
                <button type="submit" class="btn btn-warning w-100">Change Email</button>
            </form>
            <form class="w-100 pt-3 " action="./change_password.php">
                <input type="hidden" name="password_change" value="">
                <button type="submit" class="btn btn-danger w-100">Change Password</button>
            </form>
        </div>
    </div>

</div>



<?php
include "./includes/footer.php";
?>