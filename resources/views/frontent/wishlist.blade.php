

@extends('layouts.frontent-layout')

@section('content')

<div class="overlay-svg">
    <img src="https://miro.medium.com/max/441/1*9EBHIOzhE1XfMYoKz1JcsQ.gif"/>
</div>
<section class="shopping-cart spad">
    <div class="container" id="cart-container">
        @if(Auth::check())
   
        <div class="row" id="cart_table">
            <div class="col-lg-12">
                @if(count($wishlist)>0)
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                               
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody >
                           
                         
                             @foreach ($wishlist as $item)
                                 
                          
                       
                            <tr>
                                <td class="cart-pic first-row"><img src="{{asset('img/products/'.$item->get_products->get_images[0]->image_name.'')}}"></td>
                                <td class="cart-title first-row">
                                    <h5><a href="product/{{$item->get_products->slug}}" style="color: black">{{$item->get_products->product_name}}</h5>
                                </td>
                               
                                
                               
                                <td class="close-td first-row " id="delete_wishlist_item" data-wish_id ="{{$item->id}}"><i class="ti-close"></i></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                @else
                           No Items Found In wishlist
                           @endif
                
            </div>
        </div>
        @endif
       
    </div>
</section> 
@endsection

@section('scripts')

<script src="{{asset('js/frontent/wishlist.js')}}"></script>
 
@endsection