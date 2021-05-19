//add a new brand

$(document).ready(function () {
    $("#add_brand_main_button").on("click", function () {
        $('input[name="brand_name"]').attr("value", "");
        $('input[data-sub = "submit"]').attr("id", "add_brand");
        $('input[data-sub = "submit"]').attr("value", "add new Brand");

        $("#add_brand").one("click", function (e) {
            e.preventDefault();
            console.log("clicked");
            var form = new FormData();
            var file = $("#Brand_image")[0].files;
            var _token = $("#csrf").val();
            console.log(_token);
            form.append("_token", _token);
            form.append("image", file[0]);
            form.append("brand", $('input[name="brand_name"]').val());

            $.ajax({
                type: "post",
                url: "/admin/add_brand",
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
                        $("#brand_form").trigger("reset");
                        $("#brand_table").append(
                            `<tr>
                         
                            <td>${response.data.brand_name}</td>
                            
                            <td>${
                                response.data.icon
                                    ? `<img src='../../../../img/brands/${response.data.icon}' style="width:100px">`
                                    : '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASkAAACqCAMAAADGFElyAAAAMFBMVEX09PTMzMz39/fOzs7w8PDQ0NDz8/PW1tbo6OjJycns7Ozl5eXh4eHZ2dnf39/T09MBTNBqAAAB5klEQVR4nO3b3W6iUBSAUX5FQJ33f9sRRQQ61IM3JLPXuqK2JPJlY07wNMsAAAAAAAAAAAAAAAAAAAAAACCaYr+j3/Ixuqbe69od/aYPUFzafL/2Em+sum9C3VOFm6qiuV92udOQqok2VMX9sssqO+1S3UvV4UoNI7X3ooe8SiWdFLxUkXVdlXZS8FK3Mm/z+pxQIHipP+24Uko4KXSpW5u+UgpdqnovKj+vlEKXOr+X6vVp/UfV6oM+dKn+Xapcl6rKcpkqdKlfZqoauixShS51KqdS12WD6vGbxVSFLvV++NIu77SqHidt9nLoUlnRjOupfpGgmmZtNlWxS2VFX7dt2XQboeZTFbxUNqwGTqvPqHr+9G5KpdTafKIexlRKrfwI9fqsUur5yutgeevNUyk1/HxrxqOfEzXdgEo9llXt9XH0r4l6TZVSz/VnOzxM2AqVt2elpoX6PdXGrafUeHx51Wi2Jkqpx2HS9+5KpW5QUCp1J0f4UslbXsKXOqdueQlfqlfqA6VSKZVKqVRKpZq+xapSnYKX2ndSyFKlUmmGi8675Fvvqcsjlhp2WeebT6O2XaOV+nrnftqO0P9Kn3/Tqj/6bR+hujV73QJO1MA/rQEAAAAAAAAAAAAAAAAAAAAAwGd/AdrYE2FI58bQAAAAAElFTkSuQmCC"style="width:100px"/>'
                            }</td>
                           <td><a href = "#" class="btn btn-warning "  id="edit_Brand" data-toggle="modal" data-target="#exampleModal" data-id="${
                               response.data.id
                           }"><i class="fa fa-indent text-white" aria-hidden="true"></i></a>
                           <a href="#" class="btn btn-danger"  data-id="${
                               response.data.id
                           }" id="delete_Brand" ><i class="fa fa-trash text-white" aria-hidden="true" ></i></a></td>
                          </tr>`
                        );
                    }
                },
            });
        });
    });
});

//edit brand

$(document).on("click", "#edit_Brand", function () {
    $(".err").css("display", "none");
    $('input[data-sub = "submit"]').attr("id", "update");
    $('input[data-sub = "submit"]').attr("value", "Update");
    $('input[name="brand_name"]').attr(
        "value",
        $(this).closest("tr").children("td:nth(0)").html()
    );
    data_id = $(this).attr("data-id");
    $("#exampleModal").modal("show");

    $("#update").one("click", function (e) {
        e.preventDefault();
        form = new FormData();
        var file = $("#Brand_image")[0].files;
        var _token = $("#csrf").val();

        form.append("_token", _token);
        form.append("image", file[0]);
        form.append("brand", $('input[name="brand_name"]').val());
        form.append("id", data_id);
        $.ajax({
            type: "post",
            url: "/admin/edit_brand",
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
                    $("#brand_form").trigger("reset");
                    $(`a[data-id= ${data_id}]`).closest('tr').children("td:nth(0)").html(response.data.brand_name)
                  
                    console.log(response.data);
                    if(response.data.icon){
                        $(`a[data-id= ${data_id}]`).closest('tr').children("td:nth(1)").children('img').attr("src",'../../../../img/brands/'+response.data.icon+'')
                    }
                }
            },
        });
    });
});


//delete brand

$(document).on('click','#delete_Brand',function(){
    data_id = $(this).attr('data-id');
    $.ajax({
        type:"get",
        url: "/admin/deletebrand/"+data_id+"",
        
        contentType: false,
        processData: false,
        success:function(response){
              if(response.status == "success"){
                $(`a[data-id= ${data_id}]`).closest('tr').remove();
              }
        }

    })
})