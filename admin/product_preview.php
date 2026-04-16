<?php
include "./sql/conn.php";
include "./include/header.php";
include "./include/sidebar.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT p.*, 
              cat.cat_name AS category_name,
              subcat.cat_name AS subcat_name,
              s.supp_name
              FROM products p
              LEFT JOIN categories cat ON p.cat_id = cat.id
              LEFT JOIN categories subcat ON p.subcat_id = subcat.id
              LEFT JOIN suppliers s ON p.supp_id = s.id
              WHERE p.id = '$id'";

    $sql = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($sql);
}
?>

<div class="main-content">
<section class="section">
<div class="section-body">

<div class="container d-flex flex-column align-items-center">

    <!-- Thumbnail -->
    <div class="w-50 text-center mb-4">
        <?php if (!empty($record['p_thumbnail'])) { ?>
            <img src="./uploads/thumbnail/<?php echo $record['p_thumbnail']; ?>" 
                 class="img-fluid border rounded p-2" width="300">
        <?php } ?>
    </div>

    <!-- Product Details -->
    <div class="container w-75">
        <table class="table table-striped">

            <tr>
                <th>ID</th>
                <td><?php echo $record['id']; ?></td>

                <th>Product Name</th>
                <td><?php echo $record['p_name']; ?></td>
            </tr>

            <tr>
                <th>Category</th>
                <td><?php echo $record['category_name']; ?></td>

                <th>Subcategory</th>
                <td><?php echo $record['subcat_name']; ?></td>
            </tr>

            <tr>
                <th>Supplier</th>
                <td><?php echo $record['supp_name']; ?></td>

                <th>Code</th>
                <td><?php echo $record['p_code']; ?></td>
            </tr>

            <tr>
                <th>Unit Price</th>
                <td><?php echo $record['unit_price']; ?></td>

                <th>Sale Price</th>
                <td><?php echo $record['sale_price']; ?></td>
            </tr>

            <tr>
                <th>Quantity</th>
                <td><?php echo $record['qty']; ?></td>

                <th>Stock</th>
                <td><?php echo $record['stock']; ?></td>
            </tr>

            <tr>
                <th>Description</th>
                <td colspan="3"><?php echo $record['p_description']; ?></td>
            </tr>

        </table>
    </div>

    <!-- Product Images -->
    <div class="container w-75 mt-4">
        <h4>Product Images</h4>

        <div class="d-flex flex-wrap gap-3">

            <?php
            if (!empty($record['p_imgs'])) {

                $images = explode(',', $record['p_imgs']);

                foreach ($images as $img) {
            ?>
                    <img src="./uploads/product_images/<?php echo trim($img); ?>"
                         width="150"
                         class="border rounded p-1">
            <?php
                }
            } else {
                echo "<p>No images found</p>";
            }
            ?>

        </div>
    </div>

</div>

</div>
</section>
</div>

<?php include "./include/footer.php"; ?>