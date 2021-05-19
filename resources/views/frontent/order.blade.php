@extends('layouts.frontent-layout')
@section('content')

<div class="overlay-svg">
    <img src="https://miro.medium.com/max/441/1*9EBHIOzhE1XfMYoKz1JcsQ.gif"/>
</div>

<div class="order-placed-pop">
    

</div>



<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body " >
          <div class="err mb-3" style="color: red"></div>
           
          
          <form id="edit_adress_form">
              @csrf
              <input type="hidden" name="id" >
            <div class="form-group">
              <label for="formGroupExampleInput">Address</label>
              <input type="adress" class="form-control"  id="adress" name="e_address">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Land Mark</label>
              <input type="text" class="form-control" id="land-mark" name="e_land_mark">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">City</label>
              <input type="text" class="form-control" id="cun" name="e_city" >
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Post</label>
              <input type="text" class="form-control" id="post" class="post" name="e_post">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">PinCode</label>
              <input type="text" class="form-control" id="zip" name="e_pin">
            </div>
            <div class="order-btn ml-3">
                <button type="submit" class="site-btn " id="edit_adress">Update</button>
            </div> 
        </form>
          
        </div>
        
      
      </div>
    </div>
  </div>































<section class="checkout-section spad">
    <div class="container">
    <form action="" id="adress_list">
        <div class="ad-area">
            <div class="row address-show-area" >
                @if(count($address)>0)
                @foreach ($address as $index=> $adres)
                @if($index==0)
                <div class="col-md-4 address-card ml-3">
                   
                       
                    <input type="radio" id="{{$adres->id}}" name="adress" value="{{$adres->id}}" checked>
                    <input type="hidden" name="token" value="{{csrf_token()}}">
                    <label for="address">{{$adres->address}}</label>
                    <p id="land">{{$adres->land_mark}}</p>
                    <p>{{$adres->city}}</p>
                    <p>{{$adres->post}}</p>
                    <p>{{$adres->pin_code}}</p>
                    <a href="" class="bn-fg" id="edit_address" data-id="{{$adres->id}}"><i class="fa fa-pencil-square"></i></a>
                    <a href="/delete_address"  class="bn-fg" data-id="{{$adres->id}}" id="delete_adress"><i class="fa fa-trash-o"></i></a>
              
            </div>
                @else
                <div class="col-md-4 address-card ml-3">
                   
                       
                        <input type="radio" id="{{$adres->id}}" name="adress" value="{{$adres->id}}">
                        <input type="hidden" name="token" value="{{csrf_token()}}">
                        <label for="address">{{$adres->address}}</label>
                        <p id="land">{{$adres->land_mark}}</p>
                        <p>{{$adres->city}}</p>
                        <p>{{$adres->post}}</p>
                        <p>{{$adres->pin_code}}</p>
                        <a href="" class="bn-fg" id="edit_address" data-id="{{$adres->id}}"><i class="fa fa-pencil-square"></i></a>
                        <a href="/delete_address"  class="bn-fg" data-id="{{$adres->id}}" id="delete_adress"><i class="fa fa-trash-o"></i></a>
                  
                </div>
                @endif
                @endforeach
                
                @endif
            </div>
        </div>
    </form>
        <div id="err" class="mb-5" style="color: red"></div>
        <form action="#" class="checkout-form" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                   
                    <h4>Adress</h4>
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <label for="last">Address</label>
                            <input type="adress" id="adress" name="address">
                        </div>
                        <div class="col-lg-12">
                            <label for="cun-name">Land Mark</label>
                            <input type="text" id="land-mark" name="land_mark">
                        </div>
                        <div class="col-lg-12">
                            <label for="cun">City</label>
                            <input type="text" id="cun" name="city">
                        </div>
                        <div class="col-lg-12">
                            <label for="street">Post</label>
                            <input type="text" id="post" class="post" name="post">
                            
                        </div>
                        <div class="col-lg-12">
                            <label for="zip">PinCode</label>
                            <input type="text" id="zip" name="pin">
                        </div>
                       
                        <div class="order-btn ml-3">
                            <button type="submit" class="site-btn " id="add_adress">Add Address</button>
                        </div> 
                        
                        
                    </div>
                </div>
            </form>
           
                <div class="col-lg-6">
                   
                    <form id="your_order">
                       
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="err pb-3" style="color: red"></div>
                        <div class="order-total">
                            @if(count($products))
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                @foreach ($products as $product)
                                  <li class="fw-normal">{{$product->product_name}}  <span>${{$single_total[$product->id]}}</span></li>
                                @endforeach
                                @if(get_basic_details()->min_order_amount >$full_total)
                                <li class="fw-normal">Delivery Amount  <span>${{get_basic_details()->delivery_charge}}</span></li>
                                <li class="fw-normal mt-5"><b>Total Amount</b>  <span>${{$full_total+get_basic_details()->delivery_charge}}</span></li>
                                @else
                                <li class="fw-normal mt-5"><b>Total Amount</b>  <span>${{$full_total}}</span></li>
                                @endif
                            </ul>
                            
                            @endif
                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cod
                                        <input type="radio" id="pc-check" value="cod" name="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                       Online Payment
                                        <input type="radio" id="pc-paypal" value="online" name="payment" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn" id="place_order">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>   
@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src = "{{asset('js/frontent/address_handler.js')}}" ></script>   
<script src = "{{asset('js/frontent/place_order.js')}}" ></script>   
@endsection