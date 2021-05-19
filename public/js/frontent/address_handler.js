$(document).ready(function(){
    $('#add_adress').on('click',function(e){
        e.preventDefault();
        var form_data = $('#checkout-form').serialize();

        $.ajax({
            type: "post",
            url: "/add_address",
            data: form_data,
            beforeSend : function(){
                $('#add_adress').html('Loading...  <i class="fa fa-spinner" aria-hidden="true"></i>');
            },
            success: function (response) {
               if(response.status == 'error'){
                $('#add_adress').html('Add Adress');
                   $('#err').html(response.message)
               }else if(response.status == 'success'){
                $('#err').html(' ');
                $(".ad-area").load(document.URL + " .ad-area");
               }
            }
        });
    })

    $(document).on('click','#edit_address',function(e){
        e.preventDefault();
        $('.err').html('')
        
        //setting current data
        var data_id = $(this).attr('data-id');
        $.ajax({
            type: "get",
            url: "/edit_adress/"+data_id,
         beforeSend:function (){
            $('.overlay-svg').css('display','flex')
         },
            
            success: function (response) {
              if(response.status == 'success'){
                $('.overlay-svg').css('display','none')
                $('#exampleModal').modal('show');
         
          $(" input[name=e_address]").attr('value',response.data.address);
          $(" input[name=e_land_mark]").attr('value',response.data.land_mark);
          $(" input[name=e_city]").attr('value',response.data.city);
          $(" input[name=e_post]").attr('value',response.data.post_office);
          $(" input[name=e_pin]").attr('value',response.data.pin_code);
          $(" input[name=id]").attr('value',response.data.id);
        
              }
            }
        });



    })
    //update with new data

    $(document).on('click','#edit_adress',function(e){
        e.preventDefault();
       var adress = $('#edit_adress_form').serialize();
       $.ajax({
           type: "post",
           url: "/update_adress",
           data: adress,
           beforeSend:function(){
            $('#edit_adress').html('<i class="fa fa-spinner" aria-hidden="true"></i>')
           },
           
           success: function (response) {
             if(response.status =='error'){
                $('.err').html(response.message).css('color','red')
                $('#edit_adress').html('update')
             }else if(response.status == 'success'){
                $('#edit_adress').html('Update')
                $('.err').html('')
                $(".ad-area").load(document.URL + " .ad-area");
                $('#exampleModal').modal('hide');
             }
                
             
           }
       });
    })
    //delete am adress
    $(document).on('click','#delete_adress',function(e){
        e.preventDefault();
        var data_id = $(this).attr('data-id');

        $.ajax({
            type: "get",
            url: "/delete_adress/"+data_id,
            beforeSend:function(){
                $('#delete_adress').html('<i class="fa fa-spinner" aria-hidden="true"></i>')
            },

           
            success: function (response) {
               if(response.status == 'success'){
                $(".ad-area").load(document.URL + " .ad-area");
               }

               
            }
        });
    })
})