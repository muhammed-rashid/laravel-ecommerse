
//add category
$("#add_main_button").on("click", function () {
    $('input[name="category_name"]').attr("value", "");
    $('input[data-sub = "submit"]').attr("id", "add_category");
    $('input[data-sub = "submit"]').attr('value','add category');

    //ajax calling for submiting

    $("#add_category").one("click", function (e) {
        e.preventDefault();
        console.log("submit");
        var form = new FormData();
        var file = $("#file")[0].files;
        var _token = $("#csrf").val();
        console.log(_token);
        form.append("_token", _token);
        form.append("image", file[0]);
        form.append("category", $('input[name="category_name"]').val());

        $.ajax({
            type: "post",
            url: "/admin/addcategory",
            data: form,
            contentType: false,
            processData: false,

            success: function (response) {
                console.log(response.data);

                if (response.status == "error") {
                    $(".err").css("display", "block");
                    $(".err").html(response.message);
                } else if (response.status == "fail") {
                    $(".err").css("display", "block");
                    $(".err").html(response.message);
                } else {
                    $("#exampleModal").modal("hide");
                    $("#category_form").trigger("reset");
                    $("#category_table_list").append(`
                  <tr>
              <td>${response.data.id}</td>
              <td>${response.data.category}</td>
              <td>${response.data.slug}</td>
              <td>${
                  response.data.icon
                      ? `<img src='../../../../img/category/${response.data.icon}' style="width:100px">`
                      : '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASkAAACqCAMAAADGFElyAAAAMFBMVEX09PTMzMz39/fOzs7w8PDQ0NDz8/PW1tbo6OjJycns7Ozl5eXh4eHZ2dnf39/T09MBTNBqAAAB5klEQVR4nO3b3W6iUBSAUX5FQJ33f9sRRQQ61IM3JLPXuqK2JPJlY07wNMsAAAAAAAAAAAAAAAAAAAAAACCaYr+j3/Ixuqbe69od/aYPUFzafL/2Em+sum9C3VOFm6qiuV92udOQqok2VMX9sssqO+1S3UvV4UoNI7X3ooe8SiWdFLxUkXVdlXZS8FK3Mm/z+pxQIHipP+24Uko4KXSpW5u+UgpdqnovKj+vlEKXOr+X6vVp/UfV6oM+dKn+Xapcl6rKcpkqdKlfZqoauixShS51KqdS12WD6vGbxVSFLvV++NIu77SqHidt9nLoUlnRjOupfpGgmmZtNlWxS2VFX7dt2XQboeZTFbxUNqwGTqvPqHr+9G5KpdTafKIexlRKrfwI9fqsUur5yutgeevNUyk1/HxrxqOfEzXdgEo9llXt9XH0r4l6TZVSz/VnOzxM2AqVt2elpoX6PdXGrafUeHx51Wi2Jkqpx2HS9+5KpW5QUCp1J0f4UslbXsKXOqdueQlfqlfqA6VSKZVKqVRKpZq+xapSnYKX2ndSyFKlUmmGi8675Fvvqcsjlhp2WeebT6O2XaOV+nrnftqO0P9Kn3/Tqj/6bR+hujV73QJO1MA/rQEAAAAAAAAAAAAAAAAAAAAAwGd/AdrYE2FI58bQAAAAAElFTkSuQmCC"style="width:100px"/>'
              }</td>
             <td><a href = "#" class="btn btn-warning "  id="edit_category" data-toggle="modal" data-target="#exampleModal" data-id="${response.data.id}"><i class="fa fa-indent text-white" aria-hidden="true"></i></a></td>
              <td><a href="#" class="btn btn-danger"  data-id="${response.data.id}" id="delete_category" ><i class="fa fa-trash text-white" aria-hidden="true" ></i></a></td>
            </tr>
                  `);
                }
            },
        });
    });
});




//edit
$(document).on("click", "#edit_category", function () {
    $('input[data-sub = "submit"]').attr("id","update");
    $("#update").attr("value", "update");
    $('input[name="category_name"]').attr(
        "value",
        $(this).closest("tr").children("td:nth(1)").html()
    );
    var data_id = $(this).attr("data-id");

    $("#update").one("click", function (e) {
        e.preventDefault();

        var edit_form = new FormData();
        var file = $("#file")[0].files;
        var _token = $("#csrf").val();

        edit_form.append("id", data_id);
        edit_form.append("_token", _token);
        edit_form.append("image", file[0]);
        edit_form.append("category", $('input[name="category_name"]').val());

        $.ajax({
            type: "post",
            url: "/admin/editcategory",
            data: edit_form,
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
                    $("#category_form").trigger("reset");
                    $(`a[data-id= ${data_id}]`).closest('tr').children("td:nth(1)").html(response.data.category)
                    $(`a[data-id= ${data_id}]`).closest('tr').children("td:nth(2)").html(response.data.slug)
                    console.log(response.data);
                    if(response.data.icon){
                        $(`a[data-id= ${data_id}]`).closest('tr').children("td:nth(3)").children('img').attr("src",'../../../../img/category/'+response.data.icon+'')
                    }

                }
            },
        });
    });
});

//delete a category ajax call

$(document).on("click","#delete_category",function(e){
    var data_id = $(this).attr("data-id");
    $.ajax({
        type:"get",
        url: "/admin/deletecategory/"+data_id+"",
        
        contentType: false,
        processData: false,
        success:function(response){
              if(response.status == "success"){
                $(`a[data-id= ${data_id}]`).closest('tr').remove();
              }
        }

    })
})

