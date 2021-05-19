@extends('layouts.admin_layout');
@section('content')


    <div class="row pt-3 ml-1">
        <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal" id="add_banner_main_button">
            Add New Banner
        </button>
    </div>

    {{-- popup --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" err" role="alert">

                    </div>
                    <form enctype="multipart/form-data" class="mt-5">

                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Banner Heading" name="banner_heading">
                            </div>
                        </div>


                        <div class="col mt-2">

                            <div class="form-group">
                                <label>Select The Brand</label>
                                <select class="form-control" name="brand" required>
                                    @foreach (App\Models\Brand::all() as $unit)


                                        <option value="{{ $unit->id }}">{{ $unit->brand_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-row mt-2">
                            <div class="col form-group">
                                <label>Banner Description</label>
                                <textarea name="banner_description" class="form-control" id="banner_discription" rows="10"
                                    style="width: 100%">Description</textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <label for="banner_image" ><img 
                                    src="https://www.ipabp.org/bundles/faraipgis/images/default_thumbnail.jpg"
                                    style="width: 200px" id="banner_image_label"/></label>
                            <input type="file" id="banner_image" name="banner_image">
                        </div>

                        <input type="hidden" value="{{ csrf_token() }}" id="csrf">




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
                    <input type="submit" class="btn cus-b ed" id="add_banner" value="Add Banner" data-sub="submit"
                        name="banner_submit" />
                </div>


                </form>
            </div>
        </div>
    </div>



    {{-- end popup --}}


    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Banners</h3>
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
                                        aria-label="Rendering engine: activate to sort column ascending">ID
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Banner Heading</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Banner Description
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Banner Image</th>




                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="banner_table_body">

                                @foreach ($banners as $banner)



                                    <tr role="row" class="odd">
                                        <td class="" tabindex="0">{{ $banner->id }}</td>
                                        <td>{{ $banner->banner_heading }}</td>
                                        <td>{{ substr($banner->banner_description,0,150)}}</td>

                                        <td><img src="{{ asset('img/banners/' . $banner->banner_image_name . '') }}"
                                                width="100px" id="banner_img_table"/></td>


                                        <td>
                                            
                                            <a href="" class="btn cus-b" data-id="{{$banner->id}}" id="delete_banner"><i
                                                    class="fa fa-trash" aria-hidden="true">&nbsp;Delete </i></a>


                                        </td>
                                    </tr>
                                @endforeach







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

    <script src="{{ asset('js/banner_handler.js') }}"></script>



@endsection
