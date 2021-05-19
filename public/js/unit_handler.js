$("#add_uint_main_button").on("click", function () {
    $('input[name="unit_name"]').attr("value", "");
    $('input[data-sub = "submit"]').attr("id", "add_unit");
    $('input[data-sub = "submit"]').attr("value", "add an Unit");

    $("#add_unit").one("click", function (e) {
        e.preventDefault();
        var form = new FormData();
        var _token = $("#csrf").val();
        console.log(_token);
        form.append("_token", _token);

        form.append("unit", $('input[name="unit_name"]').val());

        $.ajax({
            type: "post",
            url: "/admin/add_unit",
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
                    $("#unit_form").trigger("reset");

                    $("#unit_table").append(`
                  <tr>
              <td>${response.data.unit}</td>
          
              
             <td><a href = "#" class="btn btn-warning "  id="edit_unit" data-toggle="modal" data-target="#exampleModal" data-id="${response.data.id}"><i class="fa fa-indent text-white" aria-hidden="true"></i></a>
              <a href="#" class="btn btn-danger"  data-id="${response.data.id}" id="delete_unit" ><i class="fa fa-trash text-white" aria-hidden="true" ></i></a></td>
            </tr>
                  `);
                }
            },
        });
    });
});

//edit units
$(document).on("click", "#edit_unit", function () {
    $('input[name="unit_name"]').attr(
        "value",
        $(this).closest("tr").children("td:nth(0)").html()
    );
    var dat_id = $(this).attr("data-id");
    $("#data_id").attr("value", dat_id);

    $('input[data-sub = "submit"]').attr("id", "update");
    $('input[data-sub = "submit"]').attr("value", "Update");
    $("#exampleModal").modal("show");

    $('#update').one('click',function(e){
        e.preventDefault();
        var form = new FormData();
        var token =  $('#csrf').val();
        form.append('_token',token);
        form.append('unit',$('input[name="unit_name"]').val())
        form.append('id',$('#data_id').val())
   

    $.ajax({
        type: "post",
        url: "/admin/edit_unit",
        data: form,
        contentType: false,
        processData: false,
        success: function (response) {
            if(response.status=='error'){
                $('.err').css('display','block');
                $('.err').html(response.message);
            }else if(response.status =='fail'){
                $('.err').css('display','block');
                $('.err').html(response.message)
            }else{
                console.log(response);
                $("#exampleModal").modal("hide");
                $("#attribute_form").trigger("reset");
                $(`a[data-id = ${response.data.id}]`).closest('tr').children('td:nth(0)').html(response.data.unit);
            }
        }
    });
});
});

$(document).on('click','#delete_unit',function(){
    console.log('clicked');
    data_id = $(this).attr('data-id');

    $.ajax({
        type: "get",
        url: `/admin/delete_unit/${data_id}`,


        success: function (response) {
           if(response.status=="success"){
               $(`a[data-id =${data_id}]`).closest('tr').remove();
           }
        }
    });
})