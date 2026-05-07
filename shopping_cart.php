<?php
include "./sql/conn.php";


if (isset($_GET['add'])) {

    $productId = intval($_GET['add']);

    $query = "SELECT * FROM products WHERE id='$productId'";
    $sql = mysqli_query($conn, $query);

    if (mysqli_num_rows($sql) > 0) {

        $product = mysqli_fetch_assoc($sql);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {

            $_SESSION['cart'][$productId]['quantity']++;
        } else {

            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['p_name'],
                'price' => $product['sale_price'],
                'image' => $product['p_thumbnail'],
                'code' => $product['p_code'],
                'quantity' => 1
            ];
        }
    }

    header("Location: shopping_cart.php");
    exit();
}


if (isset($_GET['remove'])) {

    $removeId = intval($_GET['remove']);

    unset($_SESSION['cart'][$removeId]);

    header("Location: shopping_cart.php");
    exit();
}


include "./includes/header.php";
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
                                <th>Product</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $total = 0;

                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                                foreach ($_SESSION['cart'] as $item) {

                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;

                            ?>

                                    <tr>

                                        <td class="col-1 p-2">
                                            <img class="rounded"
                                                src="./admin/uploads/thumbnail/<?php echo $item['image'] ?>"
                                                width="50">
                                        </td>

                                        <td class="col-2 p-2">
                                            <?php echo $item['name'] ?>
                                        </td>

                                        <td class="col-1 p-2">
                                            <?php echo $item['code'] ?>
                                        </td>

                                        <td class="col-2 p-2">
                                            <?php echo $item['quantity'] ?>
                                        </td>

                                        <td class="col-1 p-2">
                                            <?php echo $subtotal ?> PKR
                                        </td>

                                        <td class="col-1 p-2">
                                            <a class="btn btn-danger"
                                                href="shopping_cart.php?remove=<?php echo $item['id'] ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>

                                <?php
                                }
                            } else {
                                ?>

                                <tr>
                                    <td colspan="6" class="text-center">
                                        Cart is Empty
                                    </td>
                                </tr>

                            <?php } ?>
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
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
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
            <div class="w-50">
                <div class="cart__total ml-auto w-75">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span><?php echo $total ?> PKR</span></li>
                        <li>Total <span><?php echo $total ?> PKR</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
include "./includes/footer.php";
?>