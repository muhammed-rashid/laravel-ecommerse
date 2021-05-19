

@extends('layouts.frontent-layout')
@section('content')

 <!-- Hero Section Begin -->
@if(count($banner)>0)

 <section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($banner as $ban)
       
        <div class="single-hero-items set-bg" data-setbg="{{asset('img/banners/'.$ban->banner_image_name.'')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                       
                        <h1>{{$ban->banner_heading}}</h1>
                        <p>{{$ban->banner_description}}</p>
                        <a href="/{{$ban->product_id}}/brands" class="primary-btn">Shop Now</a>
                    </div>
                </div>
                {{-- <div class="off-card">
                    <h2>Sale <span>50%</span></h2>
                </div> --}}
            </div>
        </div>
             
        @endforeach
        
    </div>
</section>
@endif
<!-- Hero Section End -->

<!-- Banner Section Begin -->
@if(count($ads)>0)

<div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            @foreach ($ads as $item)
    

            <div class="col-lg-4">
                <a href="product/{{$item->product_slug}}" style="cursor: pointer">
                <div class="single-banner">
                    <img src="{{asset('img/ads/'.$item->image_name.'')}}" alt="">
                    <div class="inner-text">
                      
                    </div>
                </div>
            </a>
            </div>

            @endforeach
            
        </div>
    </div>
</div>
@endif
<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
@if(count($latest_product)>0)
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-8 offset-lg-2">
                <div class="filter-control">
                    
                </div>
                <div class="product-slider owl-carousel">
                    @foreach ($latest_product as $product)
                       
                 
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{asset('img/products/'.$product->get_images[0]->image_name.'')}}" alt="">
                            @if($product->stock>0)
                            @if($product->discounted_price );
                            <div class="sale">Offer</div>
                            @endif
                            @else
                            <div class="sale" style="background-color:red">Out Of stock</div>
                            @endif
                            <div class="icon" id="wishlist" data-id="{{$product->id}}">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                @if($product->stock>0)
                                <li class="w-icon active"  id="add-to_cart" data-id="{{$product->id}}"><a href="#"><i class="icon_bag_alt"></i></a></li>@endif
                                <li class="quick-view"><a href="/product/{{$product->slug}}">+ Quick View</a></li>
                                
                            </ul>
                        </div>
                        <div class="pi-text">
                         
                            <a href="#">
                                <h5>{{$product->product_name}}</h5>
                            </a>
                            @if($product->discounted_price)
                            <div class="product-price">
                               {{$product->discounted_price}}
                               <span>${{$product->price}}</span>
                            </div>
                            @else
                            <div class="product-price">
                                {{$product->price}}
                               
                             </div>
                             @endif
                        </div>
                    </div>
                    @endforeach
                   
                    
                </div>
            </div>
        </div>
    </div>
</section> 

@endif

<!-- Deal Of The Week Section Begin-->
<section class="deal-of-week set-bg spad" data-setbg="{{asset('img/frontent/time-bg.jpg')}}">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Deal Of The Week</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                    consectetur adipisicing elit </p>
                <div class="product-price">
                    $35.00
                    <span>/ HanBag</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>12</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>40</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>52</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="#" class="primary-btn">Shop Now</a>
        </div>
    </div>
</section>
<!-- Deal Of The Week Section End -->

<!-- Man Banner Section Begin -->
@if(count($offer)>0)
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-lg-8 offset-lg-2">
                <h2>Offer Products</h2>
                <div class="filter-control">
                   
                </div>
                <div class="product-slider owl-carousel">
                    @foreach ($offer as $product)
                        
                   
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{asset('img/products/'.$product->product_frome_offer->get_images[0]->image_name.'')}}" alt="">
                            @if($product->product_frome_offer->stock>0)
                            <div class="sale">Offer</div>
                            @else
                            <div class=" sale " style="background-color:red">Out Of stock</div>
                            @endif
                            
                            <div class="icon" id="wishlist" data-id="{{$product->product_frome_offer->id}}">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                @if($product->product_frome_offer->stock>0)
                                <li class="w-icon active" id="add-to_cart" data-id="{{$product->product_frome_offer->id}}" ><a href="#" ><i class="icon_bag_alt"></i></a></li>
                                @endif
                                <li class="quick-view"><a href="/product/{{$product->product_frome_offer->slug}}">+ Quick View</a></li>
                               
                            </ul>
                        </div>
                        <div class="pi-text">
                         
                            <a href="#">
                               
                                <h5>{{$product->product_frome_offer->product_name}}</h5>
                            </a>
                            <div class="product-price">
                           {{$product->product_frome_offer->discounted_price}}
                            
                                <span>${{$product->product_frome_offer->price}}</span>
                            </div>
                        </div>
                    </div>
                 
                    @endforeach
                  
                </div>
            </div>
            
        </div>
    </div>
</section>
@endif
<!-- Man Banner Section End -->




@endsection
@section('scripts')
<script src="{{asset('js/frontent/cart.js')}}"></script> 
<script src="{{asset('js/frontent/productsHandler.js')}}"></script> 
@endsection