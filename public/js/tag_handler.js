//open add form
$("#add_tag_main_button").on("click", function () {
    $("#tag_name").attr("value", " ");
    $(".wd").html("");

    $('button[data-id="tag_sub"]').attr("id", "add_tag").html("Add tag");;
});
//add new tags
$(document).on("click", "button[id='add_tag']", function (e) {
    e.preventDefault();
    data = $("#tag_form").serialize();

    $.ajax({
        type: "post",
        url: "/admin/tags",
        data: data,

        beforeSend:function(){
            $('button[data-id="tag_sub"]').html('<i class="fa fa-spinner text-white" aria-hidden="true"></i>');
        },

        success: function (response) {
            if (response.status == "error") {
                $(".wd").html(response.message);
            }
            if (response.status == "success") {
                $("#exampleModal").modal("hide");
                $("#tags_form").trigger("reset");
                $(".tg").load(document.URL + " .tg");
            }
        },
    });
});
//open edit
$(document).on("click", "#edit_tag", function () {
   
    $('button[data-id="tag_sub"]').attr("id", "update_tag").html("Update");
    $("#exampleModal").modal("show");
    $("#tag_name").attr(
        "value",
        $(this).closest("tr").children("td:nth(1)").html()
    );
    $(".wd").html("");

    $('input[name="tag_id"]').attr("value", $(this).attr("data-id"));
});
//update query

$(document).on("click", "button[id='update_tag']", function (e) {
    e.preventDefault();

    update_data = $("#tag_form").serialize();

    $.ajax({
        type: "post",
        url: "/admin/update_tags",
        data: update_data,
        beforeSend:function(){
            $('button[data-id="tag_sub"]').html('<i class="fa fa-spinner text-white" aria-hidden="true"></i>');
        },

        success: function (response) {
            if (response.status == "error") {
                $(".wd").html(response.message);
            } else if (response.status == "success") {
                $("#exampleModal").modal("hide");
                $("#tags_form").trigger("reset");
                $(".tg").load(document.URL + " .tg");
            }
        },
    });
});

//delete tag form request enter here

$(document).on('click','#delete_tag',function(){
    tag_id = $(this).attr('data-id');
    $(this).html('<i class="fa fa-spinner text-white" aria-hidden="true"></i>')

    $.ajax({
        type: "get",
        url: "/admin/delete-tag/"+tag_id,

        success: function (response) {
          if(response.status == 'success'){
            $(".tg").load(document.URL + " .tg");
          }
        }
    });
})