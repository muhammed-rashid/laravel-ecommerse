@extends('layouts.frontent-layout');
@section('content')
    


<div class="breacrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Search</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-shop spad">
    <div class="container">
       
        <div class="row">
            
            <div class="col-lg-12 order-1 order-lg-2">
                
                <div class="product-list">
                    <div class="row product_list append_pro">
                        @if(count($search_result)>0)
                      @foreach ($search_result as $product)
                       

                      <div class="col-lg-4 col-sm-6 product ">
                        <div class="product-item ">
                            <div class="pi-pic">
                                <img src="{{asset('img/products/'.$product->get_images[0]->image_name.'')}}" alt="" >
                                @if($product->stock==0)
                                <div class="sale" style="background: red"> Out Of stock</div>
                                @endif
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    @if($product->stock>0)
                                    <li class="w-icon active" id="add-to_cart" data-id="{{$product->id}}"><a href="#"><i class="icon_bag_alt"></i></a></li>@endif
                                    <li class="quick-view" data-product_id = ><a href="/product/{{$product->slug}}" >+ Quick View</a></li>
                                    <p class="new" style="display: none"></p>
                                    <li class="w-icon"><a  href="/product/"><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$product->categories[0]->category}}</div>
                                <a href="#">
                                    <h5>{{$product->product_name}}</h5>
                                </a>
                                @if($product->discounted_price)
                                <div class="product-price">
                                    {{$product->discounted_price}}
                                    <span>{{$product->price}}</span>
                                </div>
                                @else
                                <div class="product-price">
                                    {{$product->price}}
                                    
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>




                      @endforeach
                        
                        
                        
                      
                       @endif
                    </div>
                    
                </div>
                
            </form>

































            </div>
        </div>
    </div>
</section>








@endsection


