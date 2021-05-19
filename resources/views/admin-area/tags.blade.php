@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
<div class="jumbotron bg-white" height="300px">
   
      <h1 class="text-gray">Tags</h1>
      <p class="text-gray">Admin / <b>Tags</b></p>
   
</div>
<div class="row pt-3 ml-1">
    <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal"
        id="add_tag_main_button">
        Add New Tag
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
            <form method="POST" id="tag_form">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <label for="">Tag Name</label>
                        <input type="hidden" name="tag_id">
                        <input type="text" class="form-control" placeholder="Tag Name" name="tag_name" id="tag_name">
                    </div>
                </div>

               
            





        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
            <button class="btn cus-b ed" data-id="tag_sub" id="add_tag"  >Add tag</button>
        </div>


        </form>
    </div>
</div>
</div>



{{-- end popup --}}
    
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Units</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body tg">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row ">
                <div class="col-sm-12">
                    <table id="unit_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column ascending">#
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column ascending">Tag
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column ascending">slug
                                </th>
                                
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Actions</th>


                            </tr>
                        </thead>
                        <tbody>
           
              @if(count($tags)>0)
              @foreach ($tags as $tag)
    




                            <tr role="row" class="odd">
                                <td class="" tabindex="0">{{$tag->id}}</td>
                                <td class="" tabindex="0">{{$tag->tag_name}}</td>
                                <td class="" tabindex="0">{{$tag->tag_slug}}</td>
                                
                                <td>
                                    <a class="btn cus-b"   id="edit_tag" data-id ='{{$tag->id}}' ><i class="fa fa-indent text-white" aria-hidden="true"
                                          ></i></a>
                                    <a class="btn cus-b"  id="delete_tag" data-id="{{$tag->id}}"><i class="fa fa-trash text-white" aria-hidden="true"
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
    <script src="{{asset('js/tag_handler.js')}}"></script>
@endsection()
