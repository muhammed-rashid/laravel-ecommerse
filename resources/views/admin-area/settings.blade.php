
@extends('layouts.admin_layout');
@section('content')
<div class="pt-5"></div>
<div class="jumbotron bg-white" height="300px">
   
      <h1 class="text-gray">Settings</h1>
      <p class="text-gray">Admin / <b>Settings</b></p>
   
</div>
 

    <div class="card">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">User Management</a>
            </li>
           
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                
<div class="container-fluid mt-5 ml-2">
   
    <form action="" method="POST" id="settings_form">
       
        @csrf
        <input type="hidden" name="id" value="@if($basic_details){{$basic_details->id}}@endif">
        <div class="row ">
            <div class="col-md-2">Delivery Charge :</div>
            <div class="col-md-4">

                <input type="text" name="delivery_charge" placeholder="Delivery charge"class="form-control" value="@if($basic_details){{$basic_details->delivery_charge}}@endif">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">Min Order Amount :</div>
            <div class="col-md-4">

                <input type="text" name="Min_order_amount" placeholder="Min Order Amount"  class="form-control"value="@if($basic_details){{$basic_details->min_order_amount}}@endif">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2">Support Whatsapp No :</div>
            <div class="col-md-4">

                <input type="text" name="support_whatsapp_number" placeholder="Support Whatsapp No" class="form-control"value="@if($basic_details){{$basic_details->support_whatsapp_number}}@endif">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2">Support Number : </div>
            <div class="col-md-4">

                <input type="text" name="support_number" placeholder="Support Number"  class="form-control" value="@if($basic_details){{$basic_details->support_number}}@endif">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2">Support Email :</div>
            <div class="col-md-4">

                <input type="text" name="support_email" placeholder="Support Email"  class="form-control" value="@if($basic_details){{$basic_details->support_email}}@endif">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2">Store Address :</div>
            <div class="col-md-4">

               <textarea name="store_adress" id=""  rows="10" width="100%" class="form-control" placeholder="Store Adress">@if($basic_details){{$basic_details->store_adress}}@endif</textarea>
            </div>
        </div>
        <hr class="mt-5">

        <input type="submit" value="Save Settings" class="btn cus-b" id="save_settings">
        <div class="err-show"></div>
    </form>
</div>

             
                
                





            </div>
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
             
                
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="banner_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Rendering engine: activate to sort column ascending">#
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Full Name</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Email Address
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Password Reset</th>




                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Created at</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Actions</th>
                                        
                                </tr>
                            </thead>
                            <tbody id="banner_table_body">

                              



                                    <tr role="row" class="odd">
                                        <td class="" tabindex="0">1</td>
                                        <td>John Doe</td>
                                        <td>John@email.com</td>

                                        <td>reset</td>

<td>25-04-1999</td>
                                        <td>
                                            
                                            <a href="" class="btn cus-b" data-id="" id="delete_banner"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>


                                        </td>
                                    </tr>
                               







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
   
    <script src="{{ asset('js/basic_settings.js') }}"></script>
    
@endsection
