$(document).ready(function () {
    $("#add_banner_main_button").on("click", function () {
        $(".err").css({ display: "block", color: "red" }).html("");
        $(".err").css({ display: "block", color: "red" }).html("");
        $('input[name ="banner_submit"]').attr("id", "add_banner");
        $('input[name ="banner_submit"]').attr("value", "Add Banner");

        $("#add_banner").on("click", function (e) {
            e.preventDefault();

            var form = new FormData();
            var file = $(`input[name='banner_image']`)[0].files;
            var _token = $("#csrf").val();
            var banner = $(`input[name='banner_heading']`).val();
            var disc = $("#banner_discription").val();
            var brand = $(`select[name='brand']`).val();

            form.append("banner_description", disc);
            form.append("banner_heading", banner);
            form.append("_token", _token);
            form.append("banner_image", file[0]);
            form.append("brand", brand);

            $.ajax({
                type: "post",
                url: "/admin/banner",
                data: form,

                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#add_banner').attr('value','Loading..')
                },
                success: function (response) {
                    if (response.status == "error") {
                        $(".err")
                            .css({ display: "block", color: "red" })
                            .html(response.message);
                            $('#add_banner').attr('value','Add Banner')
                    } else if (response.status == "success") {
                        $(".err").html("");
                        $('#add_banner').attr('value','Add Banner')
                        $("#exampleModal").modal("hide");

                        $("#banner_table_body").prepend(
                            `<tr>
                     
                        <td>${response.data.id}</td>
                        <td>${response.data.banner_heading}</td>
                        <td>${response.data.banner_description.substring(0,150)}</td>
                        
                        <td>${
                            response.data.banner_image_name
                                ? `<img src='../../../../img/banners/${response.data.banner_image_name}' style="width:100px">`
                                : '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASkAAACqCAMAAADGFElyAAAAMFBMVEX09PTMzMz39/fOzs7w8PDQ0NDz8/PW1tbo6OjJycns7Ozl5eXh4eHZ2dnf39/T09MBTNBqAAAB5klEQVR4nO3b3W6iUBSAUX5FQJ33f9sRRQQ61IM3JLPXuqK2JPJlY07wNMsAAAAAAAAAAAAAAAAAAAAAACCaYr+j3/Ixuqbe69od/aYPUFzafL/2Em+sum9C3VOFm6qiuV92udOQqok2VMX9sssqO+1S3UvV4UoNI7X3ooe8SiWdFLxUkXVdlXZS8FK3Mm/z+pxQIHipP+24Uko4KXSpW5u+UgpdqnovKj+vlEKXOr+X6vVp/UfV6oM+dKn+Xapcl6rKcpkqdKlfZqoauixShS51KqdS12WD6vGbxVSFLvV++NIu77SqHidt9nLoUlnRjOupfpGgmmZtNlWxS2VFX7dt2XQboeZTFbxUNqwGTqvPqHr+9G5KpdTafKIexlRKrfwI9fqsUur5yutgeevNUyk1/HxrxqOfEzXdgEo9llXt9XH0r4l6TZVSz/VnOzxM2AqVt2elpoX6PdXGrafUeHx51Wi2Jkqpx2HS9+5KpW5QUCp1J0f4UslbXsKXOqdueQlfqlfqA6VSKZVKqVRKpZq+xapSnYKX2ndSyFKlUmmGi8675Fvvqcsjlhp2WeebT6O2XaOV+nrnftqO0P9Kn3/Tqj/6bR+hujV73QJO1MA/rQEAAAAAAAAAAAAAAAAAAAAAwGd/AdrYE2FI58bQAAAAAElFTkSuQmCC"style="width:100px"/>'
                        }</td>
                       <td>
                       <a href="#" class="btn cus-b"  data-id="${
                           response.data.id
                       }" id="delete_banner" ><i class="fa fa-trash text-white" aria-hidden="true" >&nbsp; Delete </i></a></td>
                      </tr>`
                        );
                    }
                },
            });
        });
    });
    //delete banner
    $(document).on('click','#delete_banner',function(e){
        e.preventDefault();

       data_id = $(this).attr('data-id')
       $.ajax({
           type: "get",
           url: "/admin/banner-delete/"+data_id,
           beforeSend:function(){
               $(`a[data-id=${data_id}]`).html('<i class="fa fa-spinner" aria-hidden="true"></i>&nbsp; Deleting')
           },
           
           success: function (response) {
               if(response.status == 'error'){
                $(`a[data-id=${data_id}]`).html('<i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete')
               }
               if(response.status =="success"){
                $(`a[data-id=${data_id}]`).closest('tr').remove();
               }
           }
       });

       
    })

   
});
