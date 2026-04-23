<?php
include "../../sql/conn.php";

if (isset($_POST) && !empty($_POST)) {

    $roleName = mysqli_real_escape_string($conn, $_POST['role_name']);
    $roleType = mysqli_real_escape_string($conn, $_POST['role_type']);

    if (empty($roleName) || empty($roleType)) {
        $_SESSION['error'] = "Please fill in all fields correctly";
        header("location:../../role_table.php");
        exit();
    }

    $all_permissions = [
        "categories",
        "subcategories",
        "suppliers",
        "quantity_units",
        "products",
        "admin_management"
    ];

    $selected = $_POST['access'] ?? [];

    $data = [];

    foreach ($all_permissions as $perm) {
        if ($roleType === "All") {
            $data[$perm] = 0;
        } else if ($roleType === "Custom") {
            $data[$perm] = in_array($perm, $selected) ? 1 : 0;
        }
    }

    $categories = $data['categories'];
    $subcategories = $data['subcategories'];
    $suppliers = $data['suppliers'];
    $quantity_units = $data['quantity_units'];
    $products = $data['products'];
    $admin_management = $data['admin_management'];

    $query = "INSERT INTO `admin_role` 
    (`role_name`,`role_type`,`categories`,`subcategories`,`suppliers`,`qty_units`,`products`,`adm_manage`) 
    VALUES 
    ('$roleName','$roleType','$categories','$subcategories','$suppliers','$quantity_units','$products','$admin_management')";

    try {
        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Data Inserted Successfully";
        } else {
            $_SESSION['error'] = "Data Insertion failed";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['error'] = "Data Insertion failed";
    }

    header("location:../../role_table.php");
    exit();
}
