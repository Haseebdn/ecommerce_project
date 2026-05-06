<?php
include "./sql/conn.php";
include "./includes/header.php";

$limit = 9;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$totalProducts = '';
$catId = null;

if (isset($_GET['scId'])) {
    $subcatId = intval($_GET['scId']);
    $query = "SELECT parent_id FROM categories WHERE id='$subcatId'";
    $run = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($run);
    $catId = $row['parent_id'] ?? null;
} elseif (isset($_GET['cid'])) {
    $catId = $_GET['cid'];
}
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php

                                                $query = "SELECT id,cat_name FROM `categories` WHERE parent_id IS NULL";
                                                $sql = mysqli_query($conn, $query);
                                                while ($cat = mysqli_fetch_assoc($sql)) {
                                                ?>

                                                    <li><a href="shop.php?cid=<?php echo $cat['id'] ?? '' ?>"><?php echo $cat['cat_name'] ?? '';    ?></a></li>
                                                <?php

                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Subcategories</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php
                                                if (isset($catId)) {
                                                    $query = "SELECT id,cat_name FROM `categories` WHERE `parent_id`='$catId'";
                                                    $sql = mysqli_query($conn, $query);
                                                } else {
                                                    $query = "SELECT id,cat_name FROM `categories` WHERE `parent_id` IS NOT NULL";
                                                    $sql = mysqli_query($conn, $query);
                                                }
                                                while ($subcat = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <li><a href="shop.php?scId=<?php echo $subcat['id'] ?? "" ?>"><?php echo $subcat['cat_name'] ?? '';    ?></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <?php
                                $start = $offset + 1;
                                $end = min($offset + $limit, $totalProducts);
                                ?>
                                <p>Showing <?php echo $start ?>–<?php echo $end ?> of <?php echo $totalProducts ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET['scId'])) {
                        $subcatId = intval($_GET['scId']);

                        $countQuery = "SELECT COUNT(*) as total FROM products WHERE subcat_id = '$subcatId'";
                        $countResult = mysqli_query($conn, $countQuery);
                        $totalData = mysqli_fetch_assoc($countResult);
                        $totalProducts = $totalData['total'];

                        $query = "SELECT * FROM products WHERE subcat_id = '$subcatId' LIMIT $limit OFFSET $offset";
                    } elseif (isset($_GET['cid'])) {
                        $catId = intval($_GET['cid']);

                        $countQuery = "SELECT COUNT(*) as total FROM products WHERE cat_id = '$catId'";
                        $countResult = mysqli_query($conn, $countQuery);
                        $totalData = mysqli_fetch_assoc($countResult);
                        $totalProducts = $totalData['total'];

                        $query = "SELECT * FROM products WHERE cat_id = '$catId' LIMIT $limit OFFSET $offset";
                    } else {
                        $countQuery = "SELECT COUNT(*) as total FROM products";
                        $countResult = mysqli_query($conn, $countQuery);
                        $totalData = mysqli_fetch_assoc($countResult);
                        $totalProducts = $totalData['total'];

                        $query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
                    }

                    $sql = mysqli_query($conn, $query);
                    $totalPages = ceil($totalProducts / $limit);
                    while ($product = mysqli_fetch_assoc($sql)) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg rounded" data-setbg="./admin/uploads/thumbnail/<?php echo $product['p_thumbnail'] ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>

                                <div class="product__item__text">
                                    <h6><?php echo $product['p_name']    ?></h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5><?php echo $product['sale_price'] ?><span class="text-danger"> PKR</span></h5>
                                    <div class="product__color__select">
                                        <label for="pc-4">
                                            <input type="radio" id="pc-4">
                                        </label>
                                        <label class="active black" for="pc-5">
                                            <input type="radio" id="pc-5">
                                        </label>
                                        <label class="grey" for="pc-6">
                                            <input type="radio" id="pc-6">
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php

                    }
                    ?>


                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <?php
                            $queryParams = $_GET;

                            for ($i = 1; $i <= $totalPages; $i++) {
                                $queryParams['page'] = $i;
                                $url = "?" . http_build_query($queryParams);
                            ?>
                                <a class="<?php echo ($i == $page) ? 'active' : '' ?>" href="<?php echo $url ?>">
                                    <?php echo $i ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php
include "./includes/footer.php";
?>