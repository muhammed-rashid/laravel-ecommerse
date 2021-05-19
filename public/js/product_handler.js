$("#add_attr_pop").on("click", function () {
    $("#exampleModal").modal("show");
});

$("#add_attribute").on("click", function (e) {
    e.preventDefault();
    $("#exampleModal").modal("hide");
    content = "";
    $(".check-sel").each(function () {
        element = $(this);
        if (element.is(":checked")) {
            content += `
           <div style="margin-bottom:5px" class="row">
           <div class="col-md-2">
           ${element.attr("name")}
           <input type="hidden" name="attributes_ids[]" value="${element.val()}"/>
           </div>
           <div class="col-md-1">--</div>
           <div class="col-md-4">
            <input type="text" name="attribute_values[]" style="width:100%;border:1px solid #d8d8d8;">
           </div>
           <div class="col-md-2">
            <button class="btn btn-danger" id="delete_attr"><i class="fa fa-trash"></i></button> 
           </div>
           </div>
           `;
        }
    });

    $(".attri-listing").append(content);
});
//deleting un expectly added extra field

$(document).on("click", "#delete_attr", function () {
    $(this).closest(".row").remove();
});

//delete product from database

$(document).on("click", "#delete_product", function (e) {
    e.preventDefault();

    var data_id = $(this).attr("data-id");

    $.ajax({
        type: "get",
        url: "/admin/delete-product/" + data_id,

        success: function (response) {
            if (response.status == "fail") {
                console.log("error occured");
            } else {
                $(`a[data-id =${data_id}]`).closest("tr").remove();
            }
        },
    });
});

//delete image frome update page

$(document).on("click", "#delete_images_frome_edit", function () {
    let data_id = $(this).attr("data-id");

    $.ajax({
        type: "get",
        url: "/admin/edit/delete_image/" + data_id,

        success: function (response) {
            if (response.status == "fail") {
                console.log("error");
            } else {
                $(`i[data-id= ${data_id}]`).closest("div").remove();
            }
        },
    });
});

//delete an attribute frome update page

$(document).on("click", "#delete_attribute_also_db", function (e) {
    e.preventDefault();
    var product_atribute_id = $(this).attr("data-id");
    $.ajax({
        type: "Get",

        url: "/admin/delete-product-attribute/" + product_atribute_id,
        beforeSend: function () {
            // setting loding
            $(`button[data-id=${product_atribute_id}]`).html(
                '<i class="fa fa-spinner fa-spin  fa-fw"></i>'
            );
        },
        success: function (response) {
            if (response.status == "success") {
                $(`button[data-id=${product_atribute_id}]`)
                    .closest(".row")
                    .remove();
            } else {
                $(`button[data-id=${product_atribute_id}]`).html(
                    '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'
                );
            }
        },
    });
});

//add extra image
$("#add_extra_image").on("click", function (e) {
    e.preventDefault();
    var form = new FormData();
    var token = $("#csrf").val();
    var file = $("#image")[0].files;

    form.append("_token", token);
    form.append("image", file[0]);

    form.append("id", $("#id").val());

    $.ajax({
        type: "post",
        url: "/admin/product/add-image",
        data: form,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $("#add_extra_image").attr("value", "Loading..");
        },
        success: function (response) {
            if (response.status == "failed") {
                console.log("something went wrong");
            } else {
                $("#add_extra_image").attr("value", "Add Image");

                $("#image_list").append(`
                <div class="mb-3 col-md-2">
                            
                <div class="inner-img-con">
                    <img src="../../../../img/products/${response.data.image_name}" />
                    <i class="fa fa-trash" data-id = "${response.data.id}" id="delete_images_frome_edit"></i>
                </div>
           
                 </div>
                                  
                            
                `);
            }
        },
    });
});

//update basic details ajax call

$("#update_basic_details").on("click", function (e) {
    e.preventDefault();
    var form = new FormData();
    form.append("product_id", $("#id").val());
    let title = $(`input[name='product_title']`).val();
    let sub_title = $(`input[name='Product_sub_title']`).val();
    let categories = $(`select[name='categories[]']`).val();
    let discription = $(`textarea[name='discription']`).val();
    let unit = $(`select[name='unit']`).val();
    let brand = $(`select[name='brand']`).val();
    let price = $(`input[name='price']`).val();
    let stock = $(`input[name='stock']`).val();

    form.append("product_title", title);
    form.append("product_sub_title", sub_title);
    form.append("categories", categories);
    form.append("unit", unit);
    form.append("brand", brand);
    form.append("discription", discription);
    form.append("price", price);
    form.append("stock", stock);
    form.append("_token", $("#csrf").val());
    console.log(price);
    $.ajax({
        type: "post",
        url: "/admin/product/update-basic",
        data: form,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $("#update_basic_details").attr("value", "Updating...");
        },
        success: function (response) {
            if (response.status == "error") {
                $("#update_basic_details").attr("value", "Update");
                $(".error-update").html(response.message);
                $(".error-update")
                    .css({ color: "red", display: "block" })
                    .html(response.message);
            } else {
                $("#update_basic_details").attr("value", "Update");
                $(".error-update")
                    .css({ color: "green", display: "block" })
                    .html(response.message);
            }
        },
    });
});

//update product attributes here
$("#update_product_attributes").on("click", function (e) {
    e.preventDefault();
    $product_id = $("#id").val();

    var data = $("#at-for").serialize();

    $.ajax({
        type: "post",
        url: "/admin/update-product-attributes",
        data: data,
        $product_id,
        dataType: false,
        beforeSend: function () {
            $("#update_product_attributes").attr("value", "Updating....");
        },
        success: function (response) {
            if (response.status == "error") {
                $(".error-update-at")
                    .css({ display: "block", color: "red" })
                    .html(response.message);
                $("#update_product_attributes").attr(
                    "value",
                    "Update Attributes"
                );
            } else {
                $(".error-update-at")
                    .css({ display: "block", color: "green" })
                    .html(response.message);
                $("#update_product_attributes").attr(
                    "value",
                    "Update Attributes"
                );
            }
        },
    });
});

//update tags

$('#update_tags').on('click',function(e){
   
    e.preventDefault();
    data = $('#tags_update').serialize();
    $.ajax({
        type: "post",
        url: "/admin/update_product_tags",
        data: data,
       beforeSend : function(){
        $('#update_tags').attr('value','Updating..')
       },
        success: function (response) {
            if(response.status == "error"){
                $('.wd').html(response.messages)
                $('#update_tags').attr('value','Update tags')
            }else if(response.status == 'success'){
                $('.wd').html(response.message).css('color','green')
                $('#update_tags').attr('value','Update tags')
            }
        }
    });
})
