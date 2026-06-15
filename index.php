<?php
include "./sql/conn.php";
include "./includes/header.php";
?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="./shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <div class="hero__social">
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a href="https://x.com/" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>

                                    <a href="https://www.pinterest.com/" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>

                                    <a href="https://www.instagram.com/" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="/shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="https://x.com/" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="https://www.pinterest.com/" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>

                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2030</h2>
                        <a href="./shop.php">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="./shop.php">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2030</h2>
                        <a href="./shop.php">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section id="featured_products" class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".best-selling">Best Selling</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">

            <?php
            $query = "SELECT * FROM `products` WHERE `new_arrivals`=1 OR `best_selling`=1 OR `hot_sales`=1";
            $sql = mysqli_query($conn, $query);
            while ($product = mysqli_fetch_assoc($sql)) {
                // Build class string based on flags
                $classes = "mix";
                if ($product['new_arrivals'] == 1) $classes .= " new-arrivals";
                if ($product['best_selling'] == 1) $classes .= " best-selling";
                if ($product['hot_sales'] == 1)    $classes .= " hot-sales";
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6 <?php echo $classes; ?>">
                    <div class="product__item">
                        <a href="./shop_details.php?id=<?php echo $product['id']; ?>">
                            <div class="product__item__pic set-bg rounded"
                                data-setbg="./admin/uploads/thumbnail/<?php echo $product['p_thumbnail']; ?>">
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6><?php echo htmlspecialchars($product['p_name']); ?></h6>
                            <a href="javascript:void(0)" class="add-cart"
                                data-pid="<?php echo $product['id']; ?>">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5><?php echo htmlspecialchars($product['sale_price']); ?>
                                <span class="text-danger"> PKR</span>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<!-- <section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="img/product-sale.png" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Enjoy the feel of luxury in budget</p>
                    <h3>#Modraze</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<!-- <section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-1.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Latest Blog Section End -->

<?php
include "./includes/footer.php"
?>

<script>
    $(document).ready(function() {
        if ($('.product__filter').length) {
            var mixer = mixitup('.product__filter', {
                selectors: {
                    control: '.filter__controls li'
                },
                load: {
                    filter: '.new-arrivals' // default tab on load
                }
            });

            // Handle active class on filter buttons
            $('.filter__controls li').on('click', function() {
                $('.filter__controls li').removeClass('active');
                $(this).addClass('active');
            });
        }

        <?php if (isset($_SESSION['success'])) { ?>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "<?php echo $_SESSION['success']; ?>",
                    showConfirmButton: false,
                    timer: 2000
                });

                <?php unset($_SESSION['success']); ?>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "<?php echo $_SESSION['error']; ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
                <?php unset($_SESSION['error']); ?>
            <?php } ?>
    });
</script>