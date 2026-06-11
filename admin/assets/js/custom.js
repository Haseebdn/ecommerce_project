/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */
"use strict";
function fetchstatus(cat_id, table) {
    $.ajax({
        url: "/admin/handlers/custom.php",
        method: "POST",
        data: {
            "category": cat_id,
            "table": table
        },
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status == 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Status Updated Succesfully",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: response.msg,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    })
}

function fetchColumn(p_id, table, feature) {
    $.ajax({
        url: "/admin/handlers/product/feature.php",
        method: "POST",
        data: {
            "id": p_id,
            "table": table,
            "feature": feature
        },
        success: function (res) {
            let response = JSON.parse(res);
            console.log(response);

            if (response.status == 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Status Updated Succesfully",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    })
}