@extends('layouts.frontent-layout')
@section('content')
    <div class="overlay-svg">
        <img src="https://miro.medium.com/max/441/1*9EBHIOzhE1XfMYoKz1JcsQ.gif" />
    </div>
    <section class="shopping-cart spad">
        <div class="container" id="cart-container">


            <div class="row" id="cart_table">
                @foreach ($order_details_user as $order)


                    <div class="col-lg-12">
                        <div class="order-id-section">
                            <div class="inner-for-flex">
                                <div class="order-id">
                                    <h3>#FASHI-{{$order->id}}</h3>
                                    <div class="order-status">
                                        <p class="mt-3"><b>Order Status - </b><span data-val="{{$order->id}}">{{$order->order_status}}</span></p>
                                        
                                    </div>
                                </div>
                                @if($order->order_status != 'Cancelled' && $order->order_status !='Delivered')
                                <div class="cancel_order">
                                    <a href="#" data-va="{{$order->id}}" id="cancel_order_frontent">Cancel Order</a>
                                    @if($order->order_status == 'Pending')
                                        <a href="#" data-va="{{$order->id}}" id="retry_payment" style="background: #860a0a">Pay Now</a>
                                        @endif
                                </div>
                                @endif
                            </div>

                            <div class="cart-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th class="p-name">Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($order->get_order_details as $details)
                                    

                                        <tr>
                                            @if($details->get_product_from_order_summery->stock<$details->quantity)
                                            <p class="out">Out of stock</p>
                                            @endif
                                            <td class="cart-pic first-row"><img
                                                    src="{{ asset('img/products/'.$details->get_product_from_order_summery->get_images[0]->image_name.'') }}"
                                                    style="height: 150px"></td>
                                            <td class="cart-title first-row">
                                                <h5>{{$details->get_product_from_order_summery->product_name}}</h5>
                                            </td>
                                            @if ($details->discounted_price != null)
                                <td class="p-price first-row" id="price" >${{$details->discounted_price}}</td>
                                @else
                                            <td class="p-price first-row" id="price">${{$details->unit_price}}</td>
                                @endif
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <h4>{{$details->quantity}}</h4>
                                                </div>
                                            </td>
                                            <td class="total-price first-row" id="single_total">{{$single_product_price[$details->order_id][$details->product_id]}}</td>

                                        </tr>
        
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="col-lg-4 offset-lg-8">
                                    <div class="proceed-checkout">
                                        <ul>
                                            <li class="subtotal">Subtotal<span>{{$single_order_total[$order->id]}}</span></li>
                                            @if($total_charge_of_order_with_delivery_charge[$order->id]!=null)
                                                <li class="subtotal">Deliver Charge<span>{{$order->delivery_charge}}</span></li>
                                                <li class="cart-total">Total <span>${{$total_charge_of_order_with_delivery_charge[$order->id]}}</span></li>
                                            @else
                                            <li class="cart-total">Total <span>${{$single_order_total[$order->id]}}</span></li>
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>

        </div>
    </section>
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
 <script src="{{asset('js/order_handler.js')}}"></script>
 <script src="{{asset('js/frontent/place_order.js')}}"></script>
@endsection