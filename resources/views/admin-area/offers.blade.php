
@extends('layouts.admin_layout');
@section('content')

<div class="pt-5"></div>
<div class="jumbotron bg-white" height="300px">
   
      <h1 class="text-gray">Offers</h1>
      <p class="text-gray">Admin / <b>Offers</b></p>
   
</div>
<div class="row pt-3 ml-1">
    <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal"
        id="add_offer_main_button">
        Add New Offer
    </button>
</div>

{{-- popup --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class=" wd mb-5" role="alert">
    
                </div>
                <form method="POST" id="offer_form">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="">Offer Price</label>
                            <input type="hidden" name="offer_id">
                            <input type="text" class="form-control" placeholder="Enter Discount" name="offer_price" id="tag_name">
                        </div>
                        
                    </div>
                    <div class="col mt-2">

                        <div class="form-group">
                            <label>Select The product</label>
                            <select class="form-control" name="product" id="select_product" required>
                               <option></option>


                           

                            </select>
                        </div>
                    </div>
    
                    <div class="col">
                        <div class="form-group">
                            <label>Offer start from:</label>
          
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" class="form-control float-right" id="start" name="start_date">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Offer end date:</label>
          
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" class="form-control float-right" id="end" name="End_date">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                   
                
    
    
    
    
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
                <button class="btn cus-b ed" data-id="tag_sub" id="add_offer"  >Add Offer</button>
            </div>
    
    
            </form>
            <div class="load">
                <img src="https://media4.giphy.com/media/3oEjI6SIIHBdRxXI40/200.gif">
            </div>
        </div>
    </div>
    </div>
    
    
    
    {{-- end popup --}}


    <div class="card mt-3">
       
        <div class="card-header">
            <h3 class="card-title">Offers</h3>
        </div>
    
        <!-- /.card-header -->
        <div class="card-body offer-table">
            <div class="err mb-2"></div>
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row " >
                    <div class="col-sm-12">
                        <table id="banner_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Rendering engine: activate to sort column ascending">ID
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Product</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Discount</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Offer Start From
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Offer End</th>




                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($offers)>0)
                                @foreach ($offers as $offer)
                                    
                             
                                <tr>
<td>{{$offer->id}}</td>
<td>{{$offer->product_frome_offer->product_name}}</td>
<td>{{$offer->offer_percentage}}</td>
<td>{{$offer->offer_start_at}}</td>
<td>{{$offer->offer_end_at}}</td>
<td>  <a href="" class="btn cus-b p-2" data-id="{{$offer->id}}" id="delete_offer"><i
    class="fa fa-trash" aria-hidden="true"></i></a></td>



                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
 
    
@endsection

    

   
 @section('scripts')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="{{ asset('js/ad_handler.js') }}"></script>
 <script>
 $( function() {
    $( "#start" ).datepicker({
        showOtherMonths: true,
      selectOtherMonths: true,
      showButtonPanel: true,
      dateFormat:'yy/mm/dd',
      beforeShow: function() {
        setTimeout(function(){
            $('.ui-datepicker').css('z-index', 99999999999999);
        }, 0);
    }
    });
    $( "#end" ).datepicker({
        showOtherMonths: true,
      selectOtherMonths: true,
      showButtonPanel: true,
      dateFormat:'yy-mm-dd',
      beforeShow: function() {
        setTimeout(function(){
            $('.ui-datepicker').css('z-index', 99999999999999);
        }, 0);
    }
    });
  });
  </script>
 @endsection   
   
   
 
    
 

    


