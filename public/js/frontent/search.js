$("#da_search").on("keyup", function (e) {
    let data = $(this).val();
    if (e.keyCode != 40 && e.keyCode != 38) {
        $.ajax({
            type: "get",
            url: "/get_product_name_search?search=" + data,

            success: function (response) {
                if (response.status == "success") {
                    let content = "";
                    $(".append-area").focus();
                    if (response.data.length > 0) {
                        response.data.forEach((element, index) => {
                            if (index == 0) {
                                content += `<li tabindex="${index}" class= "selected" data-attr ="${element.product_name}" ><a href="/product/${element.slug}">${element.product_name}</a></li>`;
                            }
                            content += `<li tabindex="${index}" data-attr ="${element.product_name}"><a href="/product/${element.slug}">${element.product_name}</a></li>`;
                        });
                        $(".append-area").html(content);

                        //navigate using arrow keys
                    } else {
                        $(".append-area").html("<li>No products Found</li>");
                    }
                } else if (response.status == "empty") {
                    $(".append-area").html(" ");
                }
            },
        });
    }
});
$(window).keyup(function (e) {
    var $current = $(".searc_pop ul li.selected");
    var $next;

    if (e.keyCode == 38) {
        $next = $current.prev();
    } else if (e.keyCode == 40) {
        $next = $current.next();
    }

    if ($next.length > 0) {
        $(".searc_pop ul li.selected").removeClass("selected");
        $next.addClass("selected");
        $('input[name="search"]').val($next.attr('data-attr'));
    }
});

//click and go to another page

$('#search').on('click',function(e)
{
    window.location.href = '/search?q='+ $('input[name="search"]').val();


})