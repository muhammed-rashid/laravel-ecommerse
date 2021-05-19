$(document).ready(function () {
    $("#add_an_attribute").on("click", function () {
        $('input[name="Attribute_name"]').attr("value", "");
        $('input[data-sub = "submit"]').attr("id", "add_attribute");
        $('input[data-sub = "submit"]').attr("value", "add an Attribute");

        $("#add_attribute").one("click", function (e) {
            e.preventDefault();
            console.log("clicked");
            var form = new FormData();
            var _token = $("#csrf").val();
            console.log(_token);
            form.append("_token", _token);

            form.append("attribute", $('input[name="Attribute_name"]').val());

            $.ajax({
                type: "Post",
                url: "/admin/add_atribute",
                data: form,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == "error") {
                        $(".err").css("display", "block");
                        $(".err").html(response.message);
                    } else if (response.status == "fail") {
                        $(".err").css("display", "block");
                        $(".err").html(response.message);
                    } else {
                        $("#exampleModal").modal("hide");
                        $("#attribute_form").trigger("reset");

                        $("#attribute_table").append(
                            `<tr>
                         
                            <td>${response.data.attribute}</td>
                            
                            
                           <td><a href = "#" class="btn btn-warning "  id="edit_attribute" data-toggle="modal" data-target="#exampleModal" data-id="${response.data.id}"><i class="fa fa-indent text-white" aria-hidden="true"></i></a>
                           <a href="#" class="btn btn-danger"  data-id="${response.data.id}" id="delete_attribute" ><i class="fa fa-trash text-white" aria-hidden="true" ></i></a></td>
                          </tr>`
                        );
                    }
                },
            });
        });
    });

    $(document).on("click", "#edit_attribute", function () {
        $(".err").css("display", "none");
        $('input[data-sub = "submit"]').attr("id", "update");
        $('input[data-sub = "submit"]').attr("value", "Update");
        $('input[name="Attribute_name"]').attr(
            "value",
            $(this).closest("tr").children("td:nth(0)").html()
        );
        var data_id = $(this).attr("data-id");
        $("#exampleModal").modal("show");
        $("#data_id").attr('value',data_id)
    });
    $(document).on("click", "#update", function (e) {
        e.preventDefault();
        var form = new FormData();
        var _token = $("#csrf").val();
       
        form.append("_token", _token);
        form.append('id',data_id);
        form.append("attribute", $('input[name="Attribute_name"]').val());
        form.append("id",$('#data_id').val());
        $.ajax({
            type: "Post",
            url: "/admin/edit_atribute",
            data: form,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 'error'){
                    $(".err").css("display", "block");
                    $(".err").html(response.message);
                } else if (response.status == "fail") {
                    $(".err").css("display", "block");
                    $(".err").html(response.message);
                }
                else{
                    $("#exampleModal").modal("hide");
                    $("#attribute_form").trigger("reset");
                    $(`a[data-id= ${response.data.id}]`).closest('tr').children("td:nth(0)").html(response.data.attribute);
                }
            }
        });
    });
});

//delete the attribute
$(document).on('click','#delete_attribute',function(){
    data_id = $(this).attr('data-id');
    $.ajax({
        type:"get",
        url: "/admin/delete_atribute/"+data_id+"",
        
        contentType: false,
        processData: false,
        success:function(response){
              if(response.status == "success"){
                $(`a[data-id= ${data_id}]`).closest('tr').remove();
              }
        }

    })
})