//delete frome wishlist
$(document).on('click','#delete_wishlist_item',function(){
  var wishlist_id = $(this).attr('data-wish_id');
  $.ajax({
      type: "get",
      url: "/delete_wishlist/"+wishlist_id,
    beforeSend:function(){
        $('.overlay-svg').css('display','flex')
    },
      success: function (response) {
        if(response.status == 'success'){
            location.reload();
        }
      }
  });
})