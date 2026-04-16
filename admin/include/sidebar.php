<?php
$page = basename($_SERVER['PHP_SELF']);

function isActive($pages, $current)
{
    return in_array($current, $pages);
}
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <!-- logo -->
        <div class="sidebar-brand">
            <a href="index.php">
                <img alt="image" src="assets/img/logo.png" class="header-logo" />
                <span class="logo-name">Guru</span>
            </a>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Main</li>

            <!-- Dashboard -->
            <li class="dropdown <?php echo ($page == 'index.php') ? 'active' : ''; ?>">
                <a href="index.php" class="nav-link">
                    <i class="fa-solid fa-display"></i><span>Dashboard</span>
                </a>
            </li>

            <!-- Categories -->
            <?php $catPages = ['cat_form.php', 'cat_table.php']; ?>
            <li class="dropdown <?php echo isActive($catPages, $page) ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-layer-group"></i><span>Categories</span>
                </a>
                <ul class="dropdown-menu" style="<?php echo isActive($catPages, $page) ? 'display:block;' : ''; ?>">
                    <li class="<?php echo ($page == 'cat_form.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="cat_form.php">Add Category</a>
                    </li>
                    <li class="<?php echo ($page == 'cat_table.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="cat_table.php">View Categories</a>
                    </li>
                </ul>
            </li>

            <!-- Subcategories -->
            <?php $subcatPages = ['subcat_form.php', 'subcat_table.php']; ?>
            <li class="dropdown <?php echo isActive($subcatPages, $page) ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-layer-group"></i><span>Subcategories</span>
                </a>
                <ul class="dropdown-menu" style="<?php echo isActive($subcatPages, $page) ? 'display:block;' : ''; ?>">
                    <li class="<?php echo ($page == 'subcat_form.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="subcat_form.php">Add Subcategory</a>
                    </li>
                    <li class="<?php echo ($page == 'subcat_table.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="subcat_table.php">View Subcategories</a>
                    </li>
                </ul>
            </li>

            <!-- Suppliers -->
            <?php $suppPages = ['supplier_form.php', 'supplier_table.php']; ?>
            <li class="dropdown <?php echo isActive($suppPages, $page) ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-box"></i><span>Suppliers</span>
                </a>
                <ul class="dropdown-menu" style="<?php echo isActive($suppPages, $page) ? 'display:block;' : ''; ?>">
                    <li class="<?php echo ($page == 'supplier_form.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="supplier_form.php">Add Supplier</a>
                    </li>
                    <li class="<?php echo ($page == 'supplier_table.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="supplier_table.php">View Suppliers</a>
                    </li>
                </ul>
            </li>

            <!-- Quantity Units -->
            <?php $qtyPages = ['qtyUnit_form.php', 'qtyUnit_table.php']; ?>
            <li class="dropdown <?php echo isActive($qtyPages, $page) ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-box"></i><span>Quantity Units</span>
                </a>
                <ul class="dropdown-menu" style="<?php echo isActive($qtyPages, $page) ? 'display:block;' : ''; ?>">
                    <li class="<?php echo ($page == 'qtyUnit_form.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="qtyUnit_form.php">Add Unit</a>
                    </li>
                    <li class="<?php echo ($page == 'qtyUnit_table.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="qtyUnit_table.php">View Units</a>
                    </li>
                </ul>
            </li>

            <!-- Products -->
            <?php $productPages = ['product_form.php', 'product_table.php']; ?>
            <li class="dropdown <?php echo isActive($productPages, $page) ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fa-solid fa-box"></i><span>Products</span>
                </a>
                <ul class="dropdown-menu" style="<?php echo isActive($productPages, $page) ? 'display:block;' : ''; ?>">
                    <li class="<?php echo ($page == 'product_form.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="product_form.php">Add Product</a>
                    </li>
                    <li class="<?php echo ($page == 'product_table.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="product_table.php">View Products</a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
</div>