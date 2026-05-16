<?php
include "./sql/conn.php";
include "./includes/header.php";
$email = $_SESSION['user_email'];
?>
<style>
    #delete_btn:hover i {
        color: red;
    }
</style>

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
                                <th class="p-2">Picture</th>
                                <th class="col-2 p-2">Product</th>
                                <th class="p-2">Code</th>
                                <th class="col-2 p-2">Quantity</th>
                                <th class="p-2">Price</th>
                                <th class="p-2">Action</th>
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

                                    <td class=" p-2">
                                        <img class="rounded"
                                            src="./admin/uploads/thumbnail/<?php echo $row['p_thumbnail'] ?>"
                                            width="50">
                                    </td>

                                    <td class="col-2 p-2">
                                        <?php echo $row['p_name']    ?>
                                    </td>

                                    <td class=" p-2">
                                        <?php echo $row['p_code']    ?>
                                    </td>

                                    <td class="col-2 p-2">

                                        <button type="button"
                                            class="qty-plus btn btn-sm btn-dark font-weight-bold"
                                            data-id="<?php echo $row['id'] ?>">
                                            +
                                        </button>

                                        <input type="text"
                                            class="w-25 text-center quantity qty-input"
                                            data-id="<?php echo $row['id'] ?>"
                                            value="<?php echo $row['qty'] ?>">

                                        <button type="button"
                                            class="qty-minus btn btn-sm btn-dark font-weight-bold "
                                            data-id="<?php echo $row['id'] ?>">
                                            -
                                        </button>

                                    </td>

                                    <td class="p-2">
                                        <?php echo $row['total_price']    ?> PKR
                                    </td>

                                    <td class=" p-2">
                                        <a id="delete_btn" class="btn btn-dark"
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
                            <a  href="/shop.php">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="d-flex justify-content-end">
                            <a class=" primary-btn" href="./handlers/cart/delete_all.php"></i>Remove All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-5 justify-content-between">
            
            <?php

            $totalQuery = "SELECT SUM(total_price) as grand_total 
               FROM cart 
               WHERE u_email='$email'";

            $totalRun = mysqli_query($conn, $totalQuery);
            $totalData = mysqli_fetch_assoc($totalRun);

            $grand_total = $totalData['grand_total'] ?? 0;

            ?>
            <div class="w-75">
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
                    <?php
                    $cart_items = mysqli_num_rows($sql);
                    if ($cart_items > 0) {
                    ?>
                        <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                    <?php
                    } else {
                    ?>
                        <button class="w-100 primary-btn">Proceed to checkout</button>
                    <?php
                    }
                    ?>
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

                }
            });

        });


    });
</script>