@extends('layouts.admin_layout');
@section('content')
<div class="loading-wrapper-full-screen">
    <div class="load">
        <img src="https://media4.giphy.com/media/3oEjI6SIIHBdRxXI40/200.gif">
    </div>
</div>
    <p class="pt-2"></p>

    <div class="card  order-tbl">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true" >All orders</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false" data-val="pending">Placed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="false" data-val="Processing">Processing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="out-of-delivery-tab" data-toggle="tab" href="#out-of-delivery" role="tab"
                    aria-controls="out-of-delivery" aria-selected="false" data-val="out-for-delivery" >Out Of Delivery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="delivered-tab" data-toggle="tab" href="#delivered" role="tab"
                    aria-controls="delivered" aria-selected="false" data-val="delivered">Delivered</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab"
                    aria-controls="cancelled" aria-selected="false" data-val="Processing">Cancelled</a>
            </li>
        </ul>

        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class=" mt-3">
                   
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                               
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                @if(count($orders)>0)
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->get_user->email}}</td>
                    <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                    <td>{{$order->total_price}}</td>
                    <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                    <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                    <td>
                        <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                     {{$order->order_status}}
                                                                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                            <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                        </div>
                    </td>
                    <td>
                        <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                      
                    </td>
                </tr>
                @endforeach
                                           
                                            
                @endif
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                







            </div>









































            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <!--Pending-->
                <div class=" mt-3">
                   
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline " role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                
                                            @if(count($pending_order)>0)
                                            @foreach ($pending_order as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->get_user->email}}</td>
                                                <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                                                <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                                                <td>
                                                    <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                 {{$order->order_status}}
                                                                                                </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            @endforeach
                                                                       
                                                                        
                                            @endif
                                            
                                            
                
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
            <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">

                <div class=" mt-3">
                   <!--processing-->
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                
                
                                            @if(count($processing)>0)
                                            @foreach ($processing as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->get_user->email}}</td>
                                                <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                                                <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                                                <td>
                                                    <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                 {{$order->order_status}}
                                                                                                </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            @endforeach
                                                                       
                                                                        
                                            @endif
                
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

            <div class="tab-pane fade " id="out-of-delivery" role="tabpanel" aria-labelledby="out-of-delivery">

                <div class=" mt-3">
                   <!--out of delivery-->
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example4" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                
                
                                            @if(count($out_of_delivery)>0)
                                            @foreach ($out_of_delivery as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->get_user->email}}</td>
                                                <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                                                <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                                                <td>
                                                   
                                                    <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                 {{$order->order_status}}
                                                                                                </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            @endforeach
                                                                       
                                                                        
                                            @endif
                
                
                
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

            <div class="tab-pane fade " id="delivered" role="tabpanel" aria-labelledby="delivered">

                <div class=" mt-3">
                   <!--delivered-->
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example5" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                               
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                
                                            @if(count($delivered_order)>0)
                                            @foreach ($delivered_order as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->get_user->email}}</td>
                                                <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                                                
                                                <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                                                <td>
                                                    <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                 {{$order->order_status}}
                                                                                                </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            @endforeach
                                                                       
                                                                        
                                            @endif
                
                
                
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="tab-pane fade " id="cancelled" role="tabpanel" aria-labelledby="cancelled">

                <div class=" mt-3">
                   <!--cancelled-->
                    <!-- /.card-header -->
                    <div class="p-2">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example6" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">#
                                                </th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Customer Email</th>
                                               
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Order Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Payment Status</th>
                                                    
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status</th>
                                                
                                               
                
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="action: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                
                                            @if(count($cancelled_orders)>0)
                                            @foreach ($cancelled_orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->get_user->email}}</td>
                                                <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                                <td>{{$order->total_price}}</td>
                                                <td><a class="bg-info-type">{{$order->order_type}}</a></td>
                                                <td><a class="bg-info-type">{{$order->payment_status}}</a></td>
                                                <td>
                                                    <button class="btn-status btn btn-info btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                 {{$order->order_status}}
                                                                                                </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Pending</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">New Order</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Processing</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Out for Delivery</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Delivered</a>
                                                        <a data-id="{{$order->id}}" class="dropdown-status dropdown-item" href="#">Cancelled</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/admin/order/order_review/{{$order->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_order"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            @endforeach
                                                                       
                                                                        
                                            @endif
                
                
                
                
                
                
                
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

        </div>
    </div>





@endsection
@section('scripts')

    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   
  
    <script src="{{ asset('js/order_handler.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "paging":false,
                "info":false,
                "searching": false,
                
            });
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example3').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example4').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example5').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example6').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
           
        });

    </script>



@endsection

