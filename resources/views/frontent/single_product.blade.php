


@extends('layouts.frontent-layout')

@section('content')

<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="{{asset('img/products/'.$product->get_images[0]->image_name.'')}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        @if(count($product->get_images)>1)
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach ($product->get_images as $image)
                                <div class="pt active" data-imgbigurl="{{asset('img/products/'.$image->image_name.'')}}"><img
                                    src="{{asset('img/products/'.$image->image_name.'')}}" alt=""></div>
                                @endforeach
                                
                               
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                         @if(count($product->categories))
                                <span>{{$product->categories[0]->category}}</span> 
                                @endif
                                <h3>{{$product->product_name}}</h3>
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                           @for($i=0;$i<$rating;$i++)
                                <i class="fa fa-star"></i>
                            @endfor
                                <span>({{$rating}})</span>
                            </div>
                            <div class="pd-desc">
                                <p>{!!$product->discription!!}</p>
                                @if($product->discounted_price)
                                <h4>${{$product->discounted_price}} <span> {{$product->price}}</span></h4>
                                @else
                                <h4>${{$product->price}} </h4>
                                @endif
                            </div>
                           
                            
                            <div class="quantity">
                               @if($product->stock>0)
                                <a href="#" class="primary-btn pd-cart"  id="add-to_cart" data-id="{{$product->id}}">Add To Cart</a>
                                @else
                                <a href="#" class="primary-btn pd-cart"  >Out Of stock</a>
                                @endif

                            </div>
                            <ul class="pd-tags">
                               @if(count($product->categories)>0)
                                <li><span>CATEGORIES</span>:$product->categories[0]->category_name</li>
                               @endif
                                <li><span>TAGS</span>:@if($product->get_tags_name) 
                                    @foreach ($product->get_tags_name as $item)
                                    <span style="font-size: 12px">{{$item->tag_name}}</span>
                                    @endforeach
                                </li>
                                    @endif
                            </ul>
                            <div class="pd-share">
                                
                                <div class="pd-social">
                                    <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <div class="tab-item">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                            </li>
                        
                            <li>
                                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews</a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h5>Introduction</h5>
                                            <p>{!!$product->discription!!}</p>
                                            
                                        </div>
                                        <div class="col-lg-5">
                                            <img src="{{asset('img/products/'.$product->get_images[0]->image_name.'')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                <div class="specification-table">
                                    <table>
                                        @foreach ($product->get_attr_value as $attribute)
                                            
                                       
                                        <tr>
                                            <td class="p-catagory">{{$attribute->get_val->attribute}}</td>
                                            <td>
                                                <div class="p-price">{{$attribute->value}}</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        
                                        
                                        
                                       
                                    </table>
                                </div>
                            </div>
                          
                            <div class="tab-pane fade " id="tab-3" role="tabpanel">
                                <div class="customer-review-option rev_sec">
                                    @if(count($product->get_reviews)>0)

                                    <h4>{{count($product->get_reviews)}} Review</h4>
                                    <div class="comment-option">
                                        @foreach ($product->get_reviews as $review)
                                            
                                    
                                        <div class="co-item">
                                            <div class="avatar-pic">
                                                <img src="https://winaero.com/blog/wp-content/uploads/2018/08/Windows-10-user-icon-big.png" alt="">
                                            </div>
                                            <div class="avatar-text">
                                                <div class="at-rating">
                                                    @for($i=0;$i<=$review->rating_index;$i++)
                                                    <i class="fa fa-star"></i>
                                                   @endfor
                                                </div>
                                                <h5>{{$review->reviewed_user->email}} <span>{{$review->created_at}}</span></h5>
                                                <div class="at-reply">{{$review->review}}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                    @endif
                                    @if($ordered!=null)
                                    <div class="leave-comment">
                                        <h4>Leave A Review</h4>
                                        <form action="#" class="comment-form">
                                            <div class="row">
                                                
                                               
                                                <div class="col-lg-12">
                                                    <input type="hidden" id="product_id" value="{{$product->id}}">
                                                    <textarea placeholder="Review" name="Rating_message" required id="review_msg"></textarea>
                                                  <h4>Select a rating</h4>
                                                        <div class="v rating mb-3">
                                                            <i class="fa fa-star" data-index='0'></i>
                                                            <i class="fa fa-star" data-index='1'></i>
                                                            <i class="fa fa-star" data-index='2'></i>
                                                            <i class="fa fa-star" data-index='3'></i>
                                                            <i class="fa fa-star" data-index='4'></i>
                                                        </div>
                                                    <button type="submit" class="site-btn" id="post_review">Post Review</button>
                                                </div>
                                               
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($product->get_tags)>0)
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($product->get_tags[0]->all_tags as $pro )
               
         
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{asset('img/products/'.$pro->get_product->get_images[0]->image_name.'')}}" alt="">
                        @if($pro->get_product->stock==0)
                        <div class="sale" style="background-color:red">Out Of Stock</div>
                        @endif
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            @if($pro->get_product->stock>0)
                            <li class="w-icon active" id="add-to_cart" data-id="{{$pro->get_product->id}}"><a href="#"><i class="icon_bag_alt"></i></a></li>@endif
                            <li class="quick-view"><a href="/product/{{$pro->get_product->slug}}">+ Quick View</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                      
                        <a href="#">
                            <h5>{{$pro->get_product->product_name}}</h5>
                        </a>
                        <div class="product-price">
                            {{$pro->get_product->price}}
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
            
            
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
<script src="{{asset('js/frontent/cart.js')}}"></script> 
<script src="{{asset('js/frontent/rating.js')}}"></script> 
@endsection