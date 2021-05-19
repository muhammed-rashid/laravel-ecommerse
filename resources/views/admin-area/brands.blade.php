@extends('layouts.admin_layout')
@section('content')
    <div class="row pt-3 ml-1">
        <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal"
            id="add_brand_main_button">
            Add New Brand
        </button>
    </div>

    {{-- popup --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger err" role="alert">

                    </div>
                    <form id="brand_form" enctype="multipart/form-data">
                        
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name">
                            </div>
                         </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Brand Image</label>
                            <input type="file" class="form-control-file" id="Brand_image">
                        </div>
                        <input type="hidden" value="{{csrf_token()}}" id="csrf">





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
                    <input type="submit" class="btn cus-b ed" id="add_brand" value="Add Brand" data-sub="submit" />
                </div>


                </form>
            </div>
        </div>
    </div>



    {{-- end popup --}}




    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="brand_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Rendering engine: activate to sort column ascending">Brand Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Brand Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
@if(count($brands)>0)
@foreach ($brands as $brand)
    



                                <tr role="row" class="odd">
                                    <td class="" tabindex="0">{{$brand->brand_name}}</td>
                                    <td>@if($brand->icon)<img src="{{asset('img/brands/'.$brand->icon.'')}}" style="width:100px"/>@else<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASkAAACqCAMAAADGFElyAAAAMFBMVEX09PTMzMz39/fOzs7w8PDQ0NDz8/PW1tbo6OjJycns7Ozl5eXh4eHZ2dnf39/T09MBTNBqAAAB5klEQVR4nO3b3W6iUBSAUX5FQJ33f9sRRQQ61IM3JLPXuqK2JPJlY07wNMsAAAAAAAAAAAAAAAAAAAAAACCaYr+j3/Ixuqbe69od/aYPUFzafL/2Em+sum9C3VOFm6qiuV92udOQqok2VMX9sssqO+1S3UvV4UoNI7X3ooe8SiWdFLxUkXVdlXZS8FK3Mm/z+pxQIHipP+24Uko4KXSpW5u+UgpdqnovKj+vlEKXOr+X6vVp/UfV6oM+dKn+Xapcl6rKcpkqdKlfZqoauixShS51KqdS12WD6vGbxVSFLvV++NIu77SqHidt9nLoUlnRjOupfpGgmmZtNlWxS2VFX7dt2XQboeZTFbxUNqwGTqvPqHr+9G5KpdTafKIexlRKrfwI9fqsUur5yutgeevNUyk1/HxrxqOfEzXdgEo9llXt9XH0r4l6TZVSz/VnOzxM2AqVt2elpoX6PdXGrafUeHx51Wi2Jkqpx2HS9+5KpW5QUCp1J0f4UslbXsKXOqdueQlfqlfqA6VSKZVKqVRKpZq+xapSnYKX2ndSyFKlUmmGi8675Fvvqcsjlhp2WeebT6O2XaOV+nrnftqO0P9Kn3/Tqj/6bR+hujV73QJO1MA/rQEAAAAAAAAAAAAAAAAAAAAAwGd/AdrYE2FI58bQAAAAAElFTkSuQmCC" style="width:100px "/>@endif</td>
                                    <td>
                                        <a class="btn cus-b"   id="edit_Brand" data-id = {{$brand->id}}><i class="fa fa-indent text-white" aria-hidden="true"
                                              ></i></a>
                                        <a class="btn cus-b"  id="delete_Brand" data-id="{{$brand->id}}"><i class="fa fa-trash text-white" aria-hidden="true"
                                               ></i></a>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/brand_handler.js') }}"></script>

    <script>
        $(function() {
            $("#brand_table").DataTable({
                "responsive": true,
                "autoWidth": false,
                "paging": false,
                "info": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>
@endsection
