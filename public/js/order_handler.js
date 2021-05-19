$(document).on("click", ".dropdown-item", function () {
    let status = $(this).html();
    let order_id = $(this).attr("data-id");
    //status update
    $.ajax({
        type: "get",
        url: "/admin/order/update-order-status/" + status + "/" + order_id,
        beforeSend: function () {
            $(".loading-wrapper-full-screen").css("display", "block");
            $(".load").css("display", "block");
        },

        success: function (response) {
            $(".loading-wrapper-full-screen").css("display", "none");
            $(".load").css("display", "none");
            if (response.status == "error") {
                window.location.href = "/admin/orders";
            } else if (response.status == "success") {
                $(".order-tbl").load(document.URL + " .order-tbl");
            }
        },
    });
});



$(document).on("click", "#cancel_order_frontent", function (e) {
    e.preventDefault();
    let order_id = $(this).attr("data-va");
    $.ajax({
        type: "get",
        url: "/cancel-order/" + order_id,
        beforeSend:function(){
            $(`a[data-va=${order_id}]`).html('<i class="fa fa-spinner" aria-hidden="true"></i>')
        },
        success: function (response) {
            console.log(response);
            if (response.status == "success") {
            $(`a[data-va=${response.order_id}]`).css('display','none');
            $(`span[data-val=${response.order_id}]`).html('cancelled');

            swal("Order Cancelled",response.message, "success");

            }
        },
    });
});
