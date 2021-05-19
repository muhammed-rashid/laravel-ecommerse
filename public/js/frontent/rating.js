var stars = document.querySelectorAll(".v.rating i");
var rated_index = -1;
$(document).on("mouseover", ".fa-star", function () {
    let current = $(this).attr("data-index");
    console.log(stars);
    for (i = 0; i <= current; i++) {
        stars[i].style.color = "orange";
    }
});

$(document).on("click", ".v.rating i", function () {
    rated_index = $(this).attr("data-index");
});
$(document).on("mouseleave", ".fa-star", function () {
    reset_color();
    if (rated_index != -1) {
        for (i = 0; i <= rated_index; i++) {
            stars[i].style.color = "orange";
        }
    }
});

function reset_color() {
    $(".v.rating i").css("color", "#333");
}

//post rating to database
$(document).on('click','#post_review',function(e){
    e.preventDefault();
    var review_form = new FormData();
    var review = $("#review_msg").val();
    var product_id = $('#product_id').val();

  


    $.ajax({
        type: "get",
        url: `/add_review?review=${review}&index=${rated_index}&product_id=${product_id}`,
        beforeSend:function(){
            $('#post_review').html('<i class="fa fa-spinner" aria-hidden="true"></i>');
        },
        success: function (response) {
            if(response.status == 'success'){
                $(".rev_sec").load(document.URL + " .rev_sec");
            }
        }
    });
})