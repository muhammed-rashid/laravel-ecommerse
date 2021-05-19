$(document).ready(function(){
    $('#save_settings').on('click',function(e){
        e.preventDefault();
        data = $('#settings_form').serialize();
        $.ajax({
            type: "post",
            url: "/admin/settings",
            data: data,
            beforeSend: function(){
                $('#save_settings').attr('value','Saving...')
            },

            success: function (response) {
                   if(response.status == 'error'){
                    $('#save_settings').attr('value','Save settings')
                       $('.err-show').html(response.message);
                   }else if(response.status == 'success'){
                    $('#save_settings').attr('value','Save settings')
                       $('.err-show').css('color','green').html(response.message);
                   }           
            }
        }); 
    })
})