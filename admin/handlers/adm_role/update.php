<?php
include "../../sql/conn.php";
try {

    if (isset($_POST) && !empty($_POST)) {

        $id = mysqli_real_escape_string($conn, $_POST['edit_index']);
        $roleName = mysqli_real_escape_string($conn, $_POST['role_name']);
        $roleType = mysqli_real_escape_string($conn, $_POST['role_type']);

        if (empty($roleName) || empty($roleType)) {
            $_SESSION['error'] = "Please Fill  All Fields Correctly";
            header("location:../../role_form.php");
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

        $query = "UPDATE `admin_role` SET 
    `role_name`='$roleName',
    `role_type`='$roleType',
    `categories`='$categories',
    `subcategories`='$subcategories',
    `suppliers`='$suppliers',
    `qty_units`='$quantity_units',
    `products`='$products',
    `adm_manage`='$admin_management'
    WHERE `id`=$id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            $_SESSION['success'] = "Role Updated Successfully";
            header("location:../../role_table.php");
            exit();
        }

    }
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $_SESSION['error'] = "Something went wrong.";
    header("Location: ../../role_form.php");
    exit();
}
