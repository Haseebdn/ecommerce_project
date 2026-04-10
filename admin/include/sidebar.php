<?php  
$page=basename($_SERVER['PATH_INFO']);
print_r ($page);
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                    class="logo-name">Guru</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="basic-form.php">Add Category</a></li>
                    <li><a class="nav-link" href="export-table.php">View Categories</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Subcategory</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="basic-form.php">Add Subcategory</a></li>
                    <li><a class="nav-link" href="https://ecommerce-project.test/admin/subcat-table.php">View Subategories</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>