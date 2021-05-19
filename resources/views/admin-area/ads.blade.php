@extends('layouts.admin_layout');
@section('content')


    <div class="row pt-3 ml-1">
        <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal" id="add_ad_main_button">
            Add An Ad
        </button>
    </div>

    {{-- popup --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add an Ad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" err" role="alert">

                    </div>
                    <form enctype="multipart/form-data" class="mt-5" id="ad-form">
                    @csrf
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Ad Heading" name="ad_heading">
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


                        <div class="form-row mt-2">
                            <div class="col form-group">
                                <label>Ad Description</label>
                                <textarea name="ad_description" class="form-control" id="ad_desc" rows="10"
                                    style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                          <label>Prefered Size : 400 * 400</label>
                            <input type="file" id="ad_image" name="ad_image" style="display: block">
                        </div>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
                    <input type="submit" class="btn cus-b ed" id="add_ad" value="Add An Ad" data-sub="submit"
                        name="adz_submit" />
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
            <h3 class="card-title">Adz</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body ads-table">
            <div class="err"></div>
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
                                        aria-label="Browser: activate to sort column ascending">Ad Heading</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Ad Description
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Ad Image</th>




                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="ads_table_body">
@if(count($ads)>0)
@foreach ($ads as $ad)
 


<tr role="row" class="odd">
    <td class="" tabindex="0">{{ $ad->id }}</td>
    <td>{{ $ad->ad_heading }}</td>
    <td>{{ substr($ad->ad_discription,0,150)}}</td>

    <td><img src="{{ asset('img/ads/' . $ad->image_name . '') }}"
            width="100px" id="ad_img_table"/></td>


    <td>
        
        <a href="" class="btn cus-b" data-id="{{$ad->id}}" id="delete_ad"><i
                class="fa fa-trash" aria-hidden="true">&nbsp;Delete </i></a>


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



@endsection

@section('scripts')

    <script src="{{ asset('js/ad_handler.js') }}"></script>



@endsection
