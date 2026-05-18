<?php
include "../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST) && !empty($_POST)) {

    // variables
    $category = $_POST['category'];
    $table = $_POST['table'];

    // query
    $query = "UPDATE `$table`
              SET `is_active` = IF(`is_active` = 1, 0, 1)
              WHERE `id` = '$category'";

    try {

        $sql = mysqli_query($conn, $query);

        if ($sql) {

            echo json_encode([
                "status" => 200,
                "message" => "$table updated successfully"
            ]);
        } else {

            echo json_encode([
                "status" => 500,
                "message" => "$table updation failed"
            ]);
        }
    } catch (mysqli_sql_exception $e) {

        echo json_encode([
            "status" => 500,
            "message" => $e->getMessage()
        ]);
    }
}
