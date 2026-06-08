<?php
include "./sql/conn.php";
include "./includes/header.php";

$email = $_SESSION['user_email'];
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
        <div class="col col-lg-3 col-md-12 col-sm-12 col-12 p-4 d-flex flex-column align-items-center">
            <form action="./handlers/pic_upload.php" method="POST" enctype="multipart/form-data" id="picForm">

                <input type="file" name="p_pic" id="pic" class="d-none" accept="image/*" onchange="document.getElementById('picForm').submit();">

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

        <div class="col profile col-lg-6 col-md-8 col-sm-12 col-12 p-4">
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

        <div class="col col-lg-3 col-md-4 col-sm-12 col-12 pt-4">
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
    <div class="container">
        <div class="row mt-5 flex-column">
            <h2 class="mb-3">Order History</h2>

            <div class="order-tabs d-flex border-bottom mb-0">
                <button class="order-tab-btn active" data-target="pending">Pending</button>
                <button class="order-tab-btn" data-target="completed">Completed</button>
            </div>

            <?php
            $pendingOrders = [];
            $query = "SELECT * FROM `orders` WHERE `order_email`='$email' AND `status`='pending'";
            $sql = mysqli_query($conn, $query);
            while ($r = mysqli_fetch_assoc($sql)) $pendingOrders[] = $r;

            $completedOrders = [];
            $comp = "SELECT * FROM `orders` WHERE `order_email`='$email' AND `status`='completed'";
            $cql = mysqli_query($conn, $comp);
            while ($r = mysqli_fetch_assoc($cql)) $completedOrders[] = $r;
            ?>
            <div class="col">
                <div class="order-tab-pane active" id="order-pending">
                    <div class="order-table-wrap">
                        <div class="table-responsive">
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Product</th>
                                        <th>Product Code</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingOrders as $r): ?>
                                        <tr>
                                            <td class="order-no"><?= $r['order_no'] ?></td>
                                            <td><?= $r['p_name'] ?></td>
                                            <td><?= $r['p_code'] ?></td>
                                            <td><?= $r['price'] ?> PKR</td>
                                            <td><?= $r['p_qty'] ?></td>
                                            <td><strong><?= $r['t_price'] ?> PKR</strong></td>
                                            <td><span class="badge-pending">Pending</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pg-bar" id="pg-pending"></div>
                    </div>
                </div>

            </div>
            <div>
                <div class="order-tab-pane" id="order-completed">
                    <div class="order-table-wrap">
                        <div class="table-responsive">
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Product</th>
                                        <th>Product Code</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($completedOrders as $r): ?>
                                        <tr>
                                            <td class="order-no"><?= $r['order_no'] ?></td>
                                            <td><?= $r['p_name'] ?></td>
                                            <td><?= $r['p_code'] ?></td>
                                            <td><?= $r['price'] ?> PKR</td>
                                            <td><?= $r['p_qty'] ?></td>
                                            <td><strong><?= $r['t_price'] ?> PKR</strong></td>
                                            <td><span class="badge-completed">Completed</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pg-bar" id="pg-completed"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "./includes/footer.php";
?>

<script>
    function paginate(tableId, pgBarId, rowsPerPage) {
        const rows = Array.from(document.querySelectorAll('#' + tableId + ' tbody tr'));
        const total = rows.length;
        if (total <= rowsPerPage) return; // no pagination needed

        let current = 1;
        const totalPages = Math.ceil(total / rowsPerPage);

        function show(page) {
            current = page;
            rows.forEach((row, i) => {
                row.style.display = (i >= (page - 1) * rowsPerPage && i < page * rowsPerPage) ? '' : 'none';
            });
            render();
        }

        function render() {
            const bar = document.getElementById(pgBarId);
            let html = `<button class="pg-btn" onclick="void(0)" id="${pgBarId}-prev">&lsaquo;</button>`;
            for (let p = 1; p <= totalPages; p++)
                html += `<button class="pg-btn${p===current?' active':''}" data-page="${p}">${p}</button>`;
            html += `<button class="pg-btn" id="${pgBarId}-next">&rsaquo;</button>`;
            bar.innerHTML = html;

            bar.querySelector('#' + pgBarId + '-prev').disabled = current === 1;
            bar.querySelector('#' + pgBarId + '-next').disabled = current === totalPages;

            bar.querySelectorAll('[data-page]').forEach(btn =>
                btn.addEventListener('click', () => show(parseInt(btn.dataset.page)))
            );
            bar.querySelector('#' + pgBarId + '-prev').addEventListener('click', () => {
                if (current > 1) show(current - 1);
            });
            bar.querySelector('#' + pgBarId + '-next').addEventListener('click', () => {
                if (current < totalPages) show(current + 1);
            });
        }

        show(1);
    }

    paginate('order-pending', 'pg-pending', 10);
    paginate('order-completed', 'pg-completed', 10);

    document.querySelectorAll('.order-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.order-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.order-tab-pane').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('order-' + btn.dataset.target).classList.add('active');
        });
    });
</script>