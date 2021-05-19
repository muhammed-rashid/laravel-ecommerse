//infinite scroll

// var page = 1;
// $(window).scroll(function () {
//     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
//         page++;
//         loadMoreData(page);
//     }
// });

// function loadMoreData(page) {
//     $.ajax({
//         type: "get",
//         url: "?page=" + page,
//         beforeSend: function () {
//             $(".more").css("display", "block");
//         },
//         success: function (response) {
//             if (response.html == "") {
//                 $(".more").css("display", "none");

//             } else {
//                 $(".product_list").append(response.html);
//                 $(".more").css("display", "none");
//             }
//         },
//     });
// }

//first stage of sorting

$(document).on("change", "#sorting_form", function () {
    $.ajax({
        type: "get",
        url: window.location.href,
        data: $("#sorting_form").serialize(),
        beforeSend: function () {
            $(".overlay").css("display", "flex");
        },

        success: function (response) {
            $(".overlay").css("display", "none");

            // console.log(response.products.data[0].brands)
            var products = "";

            response.products.data.forEach((element) => {
                if(element.discounted_price && element.stock>0){

                
                products += `<div class="col-lg-4 col-sm-6 product ">
               <div class="product-item ">
                   <div class="pi-pic">
                       <img src="${
                           window.location.origin +
                           "/img/products/" +
                           element.get_images[0].image_name
                       }" alt="" >
                      
                       
                       <div class="icon">
                           <i class="icon_heart_alt"></i>
                       </div>
                       <ul>
                           <li class="w-icon active" id="add-to_cart" data-id="${element.id}"><a href="#"><i class="icon_bag_alt"></i></a></li>
                           <li class="quick-view" data-product_id =   ${
                               element.id
                           }><a href="/product/${
                    element.slug
                }" >+ Quick View</a></li>
                           <p class="new" style="display: none">  ${
                               element.id
                           }</p>
                           <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                       </ul>
                   </div>
                   <div class="pi-text">
                       <div class="catagory-name">Shoes</div>
                       <a href="#">
                           <h5>${element.product_name}</h5>
                       </a>
                       <div class="product-price">
                       ${element.discounted_price}
                          <span>  ${element.price}</span>
                      </div>
                      
                   </div>
               </div>
           </div>`;
        }else if(element.discounted_price && element.stock==0){
             
            products += `<div class="col-lg-4 col-sm-6 product ">
            <div class="product-item ">
                <div class="pi-pic">
                    <img src="${
                        window.location.origin +
                        "/img/products/" +
                        element.get_images[0].image_name
                    }" alt="" >
                    <div class="sale" style="background:red">Out Of stock</div>
                    <div class="icon">
                        <i class="icon_heart_alt"></i>
                    </div>
                    <ul>
                      
                        <li class="quick-view" data-product_id =   ${
                            element.id
                        }><a href="/product/${
                 element.slug
             }" >+ Quick View</a></li>
                        <p class="new" style="display: none">  ${
                            element.id
                        }</p>
                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                    </ul>
                </div>
                <div class="pi-text">
                    <div class="catagory-name">Shoes</div>
                    <a href="#">
                        <h5>${element.product_name}</h5>
                    </a>
                    <div class="product-price">
                       ${element.price}
                        
                      </div>
                   
                </div>
            </div>
        </div>`;
        }else{
            products += `<div class="col-lg-4 col-sm-6 product ">
            <div class="product-item ">
                <div class="pi-pic">
                    <img src="${
                        window.location.origin +
                        "/img/products/" +
                        element.get_images[0].image_name
                    }" alt="" >
                   
                    <div class="icon" id="wishlist" data-id="${element.id}">
                    <i class="icon_heart_alt"></i>
                </div>
                    <ul>
                        <li class="w-icon active" id="add-to_cart" data-id="${element.id}"><a href="#"><i class="icon_bag_alt"></i></a></li>
                        <li class="quick-view" data-product_id =   ${
                            element.id
                        }><a href="/product/${
                 element.slug
             }" >+ Quick View</a></li>
                        <p class="new" style="display: none">  ${
                            element.id
                        }</p>
                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                    </ul>
                </div>
                <div class="pi-text">
                    <div class="catagory-name">Shoes</div>
                    <a href="#">
                        <h5>${element.product_name}</h5>
                    </a>
                    <div class="product-price">
                       ${element.price}
                        
                      </div>
                   
                </div>
            </div>
        </div>`;
        }
            });

            $(".append_pro").html(products);
        },
    });
});
















//looking for brands to append in frontent
$(document).on("click", "#categories", function () {
    $(":checkbox").attr("checked", true);

    category = $(this).attr("value");

    $.ajax({
        type: "get",
        url: "/get-brand-frome-cat/" + category,

        success: function (response) {
            if (response.status == "success") {
                $(".th-tit").html("Brands");
                content = ``;
                get_unique(response.brands).forEach((element) => {
                    content += ` <input type="checkbox" id="${element}" name="brands[]" value="${element}">
                      <label for="${element}"> ${element}</label><br>`;
                });
                $(".brands-list").html(content);
            }
        },
    });
});

//return unique array

function get_unique(brands) {
    console.log(brands);

    var flags = [],
        output = [],
        l = brands.length,
        i;
    for (i = 0; i < l; i++) {
        if (flags[brands[i].brand_name]) continue;
        flags[brands[i].brand_name] = true;
        output.push(brands[i].brand_name);
    }
    return output;
}


//add to wishlist option
$(document).on('click','#wishlist',function(e){
    e.preventDefault();
    var product_wishlist_id = $(this).attr('data-id');
    $.ajax({
        type: "get",
        url: "/add_wishlist/"+product_wishlist_id,
        data: product_wishlist_id,

        success: function (response) {
           if(response.status == 'success'){
               window.location.href = "/wishlist"
           }else{
               window.location.href ='/email/veri'
           }
        }
    });
})

