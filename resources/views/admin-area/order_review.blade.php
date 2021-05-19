@extends('layouts.admin_layout')
@section('content')

<div class="pt-5"></div>

<div class="jumbotron bg-white " height="300px">
   
    <h1 class="text-gray">#FASHI-{{$order_details->id}}</h1>
    <p class="text-gray">Admin /Order/<b>Details</b></p>
 
</div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Fashi, Inc.
                    <small class="float-right"> {{date('d-m-Y', strtotime($order_details->created_at))}}<br></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Fashi, Inc.</strong><br>
                    {{get_basic_details()->store_adress}}    <br>
                    phone:  {{get_basic_details()->support_number}} <br>
                    Email:{{get_basic_details()->support_email}}

                    
                    
                   
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
              To
                  <address>
                   
                    {{$order_details->get_order_adress->address}}<br>
                    Land Mark: {{$order_details->get_order_adress->land_mark}}<br>
                    City: {{$order_details->get_order_adress->city}}<br>
                    Post: {{$order_details->get_order_adress->post_office}}<br>
                    @if($order_details->get_user->phone)
                    Phone: {{$order_details->get_user->phone}}<br>
                    @endif
                    Email: {{$order_details->get_user->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{$order_details->created_at.$order_details->id}}</b><br>
                  <br>
                  <b>Order ID:</b> {{$order_details->id}}<br>
                  <b>Payment Due:</b> {{date('d-m-Y', strtotime($order_details->created_at))}}<br>
             
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($order_details->get_order_details as $details)
                    <tr>
                      <td>{{$details->quantity}}</td>
                      <td>{{$details->get_product_from_order_summery->product_name}}</td>
                      <td>{{$details->order_id}}</td>
                      <td>{{$details->get_product_from_order_summery->product_sub_title}}</td>
                      <td>{{$single_total[$details->get_product_from_order_summery->id]}}</td>
                    </tr>
                    @endforeach
                    
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="{{asset('img/credit/mastercard.png')}}" alt="Visa">
                  <img src="{{asset('img/credit/american-express.png')}}" alt="Visa">
                  <img src="{{asset('img/credit/paypal2.png')}}" alt="Visa">
                  

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   <p><b>Seller Register Address</b>{{get_basic_details()->store_adress}}</p>
                  </p>
                </div>
                <!-- /.col -->
   
                <div class="col-6">
                  <p class="lead">Amount Due  : @if($order_details->order_type == 'cod') {{$order_details->total_price}}@else 0.0 @endif ./Rs</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$order_details->total_price}}</td>
                      </tr>
                      @if($delivery_charge)
                      <tr>
                        <th>Shipping:</th>
                        <td>{{$delivery_charge}}</td>
                      </tr>
                      
                      <tr>
                        <th>Total:</th>
                        <td>{{$total_plus_delivery_charge}}</td>
                      </tr>
                      @else
                      <tr>
                        <th>Total:</th>
                        <td>{{$order_details->total_price}}</td>
                      </tr>
                      @endif
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="" target="_blank" class="btn btn-default" id="print"><i class="fas fa-print"></i> Print</a>
                 
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection

@section('scripts')
<script src ="{{asset('js/print_handler.js')}}"></script>    
@endsection