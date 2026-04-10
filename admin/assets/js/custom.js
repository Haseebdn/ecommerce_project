/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

function fetchstatus(cat_id, table) {
    $.ajax({
        url: "https://ecommerce-project.test/admin/handlers/custom.php",
        method: "POST",
        data: {
            "category": cat_id,
            "table": table
        },
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status == 200) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Status Updated Succesfully",
                    showConfirmButton: false,
                    timer: 1500
                });
            }

        }


    })
}