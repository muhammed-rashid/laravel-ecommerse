$(document).on("click", "#add_ad_main_button", function () {
    $("#ad-form").trigger("reset");

    $('input[name="adz_submit"]').attr("id", "add_ad");
});

//adding new ad to database

$(document).on("click", "#add_ad", function (e) {
    e.preventDefault();
    var form = new FormData($("#ad-form")[0]);

    $.ajax({
        type: "post",
        url: "/admin/ads",
        data: form,

        contentType: false,
        processData: false,
        beforeSend: function () {
            $("#add_ad").attr("value", "Loading..");
        },
        success: function (response) {
            $("#add_ad").attr("value", "Add an Ad");

            if (response.status == "error") {
                $(".err")
                    .html(response.message)
                    .css({ display: "block", color: "red" });
            } else if (response.status == "success") {
                $(".err").html(" ");
                $(".ads-table").load(document.URL + " .ads-table");
                $("#exampleModal").modal("hide");
            }
        },
    });
});

//fetch all product frome database

$(document).one("click", "#select_product", function () {
    console.log("trigered");
    $.ajax({
        type: "get",
        url: "/admin/get_all_product",
        beforeSend: function () {
            $(".load").css("display", "block");
        },

        success: function (response) {
            console.log(response.data);
            if (response.status == "success") {
                $(".load").css("display", "none");

                content = "";

                response.data.map((element) => {
                    content += `<option value=${element.id} width ="100%">${element.product_name}</option>`;
                    return content;
                });

                $("#select_product").html(content);
            }
        },
    });
});

//delete an ad

$(document).on("click", "#delete_ad", function (e) {
    e.preventDefault();
    ad_id = $(this).attr("data-id");
    $.ajax({
        type: "get",
        url: "/admin/delete_ad/" + ad_id,
beforeSend:function(){
    $(`a[data-id=${ad_id}]`).html('<i class="fa fa-spinner" aria-hidden="true"></i>')
},
        success: function (response) {
            if (response.status == "error") {
                $(".err")
                    .css({ color: "red", display: "block" })
                    .html(response.message);
            } else if (response.status == "success") {
                $(".err").css({ display: "none" }).html("");
                $(".ads-table").load(document.URL + " .ads-table");
            }
        },
    });
});

//offers code starts here


    $(document).on('click','#add_offer',function (e) {
        e.preventDefault();
        data = $('#offer_form').serialize();
        $.ajax({
            type: "post",
            url: "/admin/offers",
            data: data,
            beforeSend : function () { 
                $('#add_offer').html('Add Offer');
             },
            success: function (response) {
              
           if(response.status=='error'){
            $('#add_offer').html('Add Offer');
               $('.wd').html(response.message);
             
           }else if(response.status == 'success'){
            $('.wd').html('');
               $('#offer_form').trigger('reset');
               $('#exampleModal').modal('hide');
               $(".offer-table").load(document.URL + " .offer-table");
           }
            }
        });
      })
//delete an offer

$(document).on('click','#delete_offer',function(e){
    e.preventDefault();
    offer_id = $(this).attr('data-id');

    $.ajax({
        type: "get",
        url: "/admin/delete_offer/"+offer_id,
        beforeSend:function(){
            $(`a[data-id=${offer_id}]`).html('<i class="fa fa-spinner" aria-hidden="true"></i>')
        },
    
        success: function (response) {
           if(response.status == 'error'){
               $('.err').html(response.message)
           }else if(response.status == 'success'){
            $('.err').html(' ')
            $(".offer-table").load(document.URL + " .offer-table");
           }
        }
    });
})