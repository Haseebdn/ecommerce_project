<?php
include "./sql/conn.php";
include "./includes/header.php";
$email = $_SESSION['user_email'];
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping_cart spad table-responsive">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th class="col-2">Product</th>
                                <th>Code</th>
                                <th class="col-2">Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php
                        $query = "SELECT * FROM `cart` where `u_email`='$email'";
                        $sql = mysqli_query($conn, $query);

                        ?>
                        <tbody>

                            <?php
                            while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr>

                                    <td class="col-1 p-2">
                                        <img class="rounded"
                                            src="./admin/uploads/thumbnail/<?php echo $row['p_thumbnail'] ?>"
                                            width="50">
                                    </td>

                                    <td class="col-2 p-2">
                                        <?php echo $row['p_name']    ?>
                                    </td>

                                    <td class="col-1 p-2">
                                        <?php echo $row['p_code']    ?>
                                    </td>

                                    <td class="col-2 p-2">

                                        <button type="button"
                                            class="qty-plus btn btn-sm btn-dark"
                                            data-id="<?php echo $row['id'] ?>">
                                            +
                                        </button>

                                        <input type="text"
                                            class="w-25 text-center quantity qty-input"
                                            data-id="<?php echo $row['id'] ?>"
                                            value="<?php echo $row['qty'] ?>">

                                        <button type="button"
                                            class="qty-minus btn btn-sm btn-danger"
                                            data-id="<?php echo $row['id'] ?>">
                                            -
                                        </button>

                                    </td>

                                    <td class="col-1 p-2">
                                        <?php echo $row['total_price']    ?>
                                    </td>

                                    <td class="col-1 p-2">
                                        <a class="btn btn-danger"
                                            href="./handlers/cart/delete_row.php?remove= <?php echo $row['id'] ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>


                            <!-- <tr>
                                <td colspan="6" class="text-center">
                                    Cart is Empty
                                </td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="#">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="d-flex justify-content-end">
                            <a class="rounded btn-danger mr-5 p-2" href="./handlers/cart/delete_all.php"><i class="mr-2 fa fa-trash"></i>Remove All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-5 justify-content-between">
            <div class="cart__discount w-25">
                <h6>Discount codes</h6>
                <form action="#">
                    <input type="text" placeholder="Coupon code">
                    <button type="submit">Apply</button>
                </form>
            </div>
            <?php

            $totalQuery = "SELECT SUM(total_price) as grand_total 
               FROM cart 
               WHERE u_email='$email'";

            $totalRun = mysqli_query($conn, $totalQuery);

            $totalData = mysqli_fetch_assoc($totalRun);

            $grand_total = $totalData['grand_total'] ?? 0;

            ?>
            <div class="w-50">
                <div class="cart__total ml-auto w-75">
                    <h6>Cart total</h6>
                    <ul>
                        <li>
                            Subtotal
                            <span>
                                <?php echo number_format($grand_total); ?> PKR
                            </span>
                        </li>

                        <li>
                            Total
                            <span>
                                <?php echo number_format($grand_total); ?> PKR
                            </span>
                        </li>
                    </ul>
                    <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
include "./includes/footer.php";
?>

<script>
    $(document).ready(function() {

        // increase qty
        $(".qty-plus").click(function() {
            let input = $(this).siblings(".qty-input");
            let qty = parseInt(input.val());
            qty++;
            input.val(qty);
            input.trigger('change');
        });

        // decrease qty
        $(".qty-minus").click(function() {
            let input = $(this).siblings(".qty-input");
            let qty = parseInt(input.val());
            if (qty > 1) {
                qty--;
                input.val(qty);
                input.trigger('change');
            }
        });

        $('.quantity').on('change', function() {

            let qty = $(this).val().trim();

            let cart_id = $(this).data('id');

            $.ajax({
                url: "https://ecommerce-project.test/handlers/quantity.php",
                method: "POST",

                data: {
                    qty: qty,
                    cart_id: cart_id
                },

                success: function(res) {

                    let response = JSON.parse(res);

                    // console.log(response);
                    location.reload();
                }
            });

        });


    });
</script>