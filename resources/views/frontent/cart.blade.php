

@extends('layouts.frontent-layout')

@section('content')
<div class="overlay-svg">
    <img src="https://miro.medium.com/max/441/1*9EBHIOzhE1XfMYoKz1JcsQ.gif"/>
</div>
<section class="shopping-cart spad">
    <div class="container" id="cart-container">
        @if(Auth::check())
        @if(count($cart_products)>0)
        <div class="row" id="cart_table">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody >
                           
                            @foreach ($cart_products as $product)
                         
                       
                       
                            
                            <tr  @if ($product->quantity > $product->get_cart_products->stock)
                              class="op"  @endif >
                            
                                <td class="cart-pic first-row"><img src="{{asset('img/products/'.$product->get_cart_products->get_images[0]->image_name.'')}}">
                                @if ($product->quantity > $product->get_cart_products->stock)
                             <p class="out-label">Out of stock</p>
                            @endif
                           
                    </td>
                                <td class="cart-title first-row">
                                    <h5>{{$product->get_cart_products->product_name}}</h5>
                                </td>
                                @if($product->get_cart_products->discounted_price!=null)
                                <td class="p-price first-row" id="price" data-va = "{{$product->get_cart_products->discounted_price}}">${{$product->get_cart_products->discounted_price}}</td>
                                @else
                                <td class="p-price first-row" id="price" data-va = "{{$product->get_cart_products->price}}">${{$product->get_cart_products->price}}</td>
                                @endif
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty" data-cart-id = "{{$product->id}}">
                                            
                                            <input type="text" value="{{$product->quantity}}" >
                                       
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price first-row" id="single_total">{{$single_total[$product->get_cart_products->id]}}</td>
                                <td class="close-td first-row " id="delete_cart_item" data-cart_id = {{$product->id}}><i class="ti-close"></i></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    
                    <div class="col-lg-4 offset-lg-8">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span>{{$sub_total}}</span></li>
                                <li class="cart-total">Total <span>{{$sub_total}}</span></li>
                            </ul>
                            <a href="/order" class="proceed-btn  @if($out) disabled @endif">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        No Items In cart
        @endif
        @endif
    </div>
</section> 
@endsection

@section('scripts')

<script src="{{asset('js/frontent/cart.js')}}"></script>
 
@endsection