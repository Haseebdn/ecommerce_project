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
        <?php
        $email = $_SESSION['user_email'];
        $query = "SELECT * FROM `user` WHERE `u_email`='$email'";
        $sql = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql);
        $p_pic = $row['p_pic'];
        ?>
        <div class="col col-md-3 p-4 d-flex flex-column align-items-center">
            <form action="./handlers/pic_upload.php" method="POST" enctype="multipart/form-data" id="picForm">

                <input type="file"
                    name="p_pic"
                    id="pic"
                    class="d-none"
                    accept="image/*"
                    onchange="document.getElementById('picForm').submit();">

            </form>
            <?php
            if ($p_pic == null) {
            ?>
                <div class="img">
                    <img class="p_pic" src="./img/default.jpg" alt=""
                        onclick="document.getElementById('pic').click()">
                </div>
            <?php
            } else {
            ?>
                <div class="img">
                    <img class="p_pic" src="./uploads/profile_pictures/<?php echo $p_pic ?>" alt="" onclick="document.getElementById('pic').click()">
                </div>
            <?php
            }
            ?>

            <?php
            if (!empty($p_pic)) {
            ?>
                <a href="./handlers/del_pic.php" class="text-danger">Remove Profile Picture</a>

            <?php
            }
            ?>
            <span class=" h5 mt-3 mb-0"><?php echo $row['last_name']  ?></span>
            <span><?php echo $row['u_email']    ?></span>
        </div>

        <div class="col profile col-md-6  p-4">
            <h3>Profile Info</h3>
            <div class="name mt-4 d-flex justify-content-between ">
                <div id="f_name">
                    <h5 class="text-danger">First Name</h5>
                    <span class="h5"><?php echo $row['f_name']    ?></span>
                </div>
                <div id="last_name">
                    <h5 class="text-danger">Last Name</h5>
                    <span class="h5"><?php echo $row['last_name']    ?></span>
                </div>
            </div>
            <div class="email mt-4">
                <h5 class="text-danger">Email</h5>
                <span class="h5"><?php echo $row['u_email']    ?></span>
            </div>
            <div class="phone mt-4">
                <h5 class="text-danger">Phone Number</h5>
                <span class="h5"><?php echo $row['p_number']    ?></span>
            </div>
            <div class="country mt-4">
                <h5 class="text-danger">Country</h5>
                <span class="h5"><?php echo $row['country']    ?></span>
            </div>
            <div class="state mt-4">
                <h5 class="text-danger">State</h5>
                <span class="h5"><?php echo $row['state']    ?></span>
            </div>
            <div class="city mt-4">
                <h5 class="text-danger">City</h5>
                <span class="h5"><?php echo $row['city']    ?></span>
            </div>
            <div class="postal_code mt-4">
                <h5 class="text-danger">Postal Code</h5>
                <span class="h5"><?php echo $row['postal_code']    ?></span>
            </div>
            <div class="address mt-4">
                <h5 class="text-danger">Address</h5>
                <span class="h5"><?php echo $row['address']    ?></span>
            </div>
        </div>

        <div class="col col-md-3 pt-4">
            <form method="POST" class="w-100 pt-5" action="./profile_edit.php">
                <input type="hidden" name="profile_edit" value="">
                <button type="submit" class="btn btn-dark w-100">Edit Profile Data</button>
            </form>
            <form method="POST" class="w-100 pt-3 " action="./change_email.php">
                <input type="hidden" name="email_change" value="">
                <button type="submit" class="btn btn-warning w-100">Change Email</button>
            </form>
            <form method="POST" class="w-100 pt-3 " action="./change_password.php">
                <input type="hidden" name="password_change" value="">
                <button type="submit" class="btn btn-danger w-100">Change Password</button>
            </form>
        </div>
    </div>

</div>



<?php
include "./includes/footer.php";
?>