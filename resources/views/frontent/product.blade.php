
@if(count($products)>0)
                        @foreach ($products as $product)
                            
                       
                        
                        <div class="col-lg-4 col-sm-6 product ">
                            <div class="product-item ">
                                <div class="pi-pic">
                                    <img src="{{asset('img/products/'.$product->get_images[0]->image_name.'')}}" alt="" >
                                    @if($product->stock==0)
                                    <div class="sale" style="background: red">Out Of Stock</div>
                                    @endif
                                   
                                    <div class="icon" id="wishlist" data-id="{{$product->id}}">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        @if($product->stock>0)
                                        <li class="w-icon active" id="add-to_cart" data-id="{{$product->id}}"><a ><i class="icon_bag_alt"></i></a></li>
                                        @endif
                                        <li class="quick-view" data-product_id = {{$product->id}}><a href="product/{{$product->slug}}" >+ Quick View</a></li>
                                        <p class="new" style="display: none">{{$product->id}}</p>
                                        <li class="w-icon"><a  href="/product/{{$product->slug}}"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    
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
        
