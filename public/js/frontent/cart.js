$(document).on("click", "#add-to_cart", function (e) {
    e.preventDefault();

    var product_id = $(this).attr("data-id");

    $.ajax({
        type: "get",
        url: "/add_to_cart/" + product_id,

        success: function (response) {
            if (response.status == "error") {
                console.log("something_went_wrong");
            } else if (response.status == "success") {
                if (response.type == "added") {
                    current_status = $("#cart_show").html();
                    $("#cart_show").html(parseInt(current_status) + 1);
                }
            } else if (response.status == "out_of_stock") {
                //handling out of stock
                window.location.href = "/shop";
            } else {
                window.location.href = "/login";
            }
        },
    });
});

//deleting an existing cart item frome db
$(document).on("click", "#delete_cart_item", function () {
    var cart_id = $(this).attr("data-cart_id");
    $.ajax({
        type: "get",
        url: "/delete_cart_item/" + cart_id,

        success: function (response) {
            if (response.status == "error") {
                console.log(response.message);
            } else if (response.status == "success") {
                current_status = $("#cart_show").html();
                $("#cart_show").html(parseInt(current_status) - 1);
                $("#cart_table").load(document.URL + " #cart_table");
            }
        },
    });
});

//updating existing product_quantity
$(document).on("click", ".pro-qty", function () {
    qty = $(this).children("input").val();
    cart_id = $(this).attr("data-cart-id");

    $.ajax({
        type: "get",
        url: "/update_cart/" + cart_id + "/" + qty,
        beforeSend: function () {
            $(".overlay-svg").css("display", "flex");
        },

        success: function (response) {
            if (response.status == "error") {
                console.log("error");
            } else if (response.status == "success") {
                location.reload();
            }
        },
    });
});
