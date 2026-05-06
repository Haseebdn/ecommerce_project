<?php
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
<section class="shopping-cart spad table-responsive">
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
                            <tr>
                                <td class=" col-1 p-2"><img class="rounded" src="./admin/uploads/thumbnail/17780418455403.jpg" width="50" alt=""></td>
                                <td class="col-2 p-2">Gents Olive Green Textured Blazer</td>
                                <td class="col-1 p-2">ma-001</td>
                                <td class="col-2 p-2"><span class="h2 pr-3">-</span><input class="w-50 text-center" type="text"><span class="h2 pl-3">+</span></td>
                                <td class="col-1 p-2">3455 pkr</td>
                                <td class="col-1 p-2"><a class="btn btn-danger" href=""><i class=" fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
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
                        <li>Subtotal <span>$ 169.50</span></li>
                        <li>Total <span>$ 169.50</span></li>
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