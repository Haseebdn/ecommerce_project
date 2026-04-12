<?php
$page = basename($_SERVER['PATH_INFO']);
print_r($page);
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <!-- logo -->
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                    class="logo-name">Guru</span>
            </a>
        </div>
        <!-- logo -->

        <ul class="sidebar-menu">

            <li class="menu-header">Main</li>
            <!-- Dashboard -->
            <li class="dropdown active">
                <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <!-- Dashboard -->
            <!-- category -->
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="cat_form.php">Add Category</a></li>
                    <li><a class="nav-link" href="cat_table.php">View Categories</a></li>
                </ul>
            </li>
            <!-- category -->
            <!-- subcategory -->
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Subcategory</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="subcat_form.php">Add Subcategory</a></li>
                    <li><a class="nav-link" href="subcat_table.php">View Subategories</a></li>
                </ul>
            </li>
            <!-- subcategory -->
        </ul>
    </aside>
</div>