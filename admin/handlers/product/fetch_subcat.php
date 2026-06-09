<?php
include "../../sql/conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = (int) $_POST['id'];

        $query = "SELECT id, cat_name
                  FROM categories
                  WHERE parent_id = $id
                  AND is_active = 1";

        $sql = mysqli_query($conn, $query);

        if (mysqli_num_rows($sql) > 0) {

            $row = mysqli_fetch_all($sql, MYSQLI_ASSOC);

            echo json_encode([
                "status" => 200,
                "message" => "Data fetched successfully",
                "data" => $row
            ]);
        } else {

            echo json_encode([
                "status" => 404,
                "message" => "No data found",
                "data" => []
            ]);
        }
    } else {

        echo json_encode([
            "status" => 400,
            "message" => "Invalid request"
        ]);
    }
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        "status" => 500,
        "message" => $e->getMessage()
    ]);
}
