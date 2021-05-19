@extends('layouts.admin_layout')
@section('content')
    <div class="row pt-3 ml-1">
        <button type="button" class="btn cus-b" data-toggle="modal" data-target="#exampleModal"
            id="add_uint_main_button">
            Add Unit
        </button>
    </div>

    {{-- popup --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger err" role="alert">

                    </div>
                    <form id="unit_form" >
                        
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Unit Name" name="unit_name">
                            </div>
                         </div>

                        
                        <input type="hidden" value="{{csrf_token()}}" id="csrf">
                        <input type="hidden" value="" id="data_id">





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cls">Close</button>
                    <input type="submit" class="btn cus-b ed" id="add_unit" value="Add Unit" data-sub="submit" />
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
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="unit_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Rendering engine: activate to sort column ascending">Unit
                                    </th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
@if(count($units)>0)
@foreach ($units as $unit)
    



                                <tr role="row" class="odd">
                                    <td class="" tabindex="0">{{$unit->unit}}</td>
                                    
                                    <td>
                                        <a class="btn cus-b"   id="edit_unit" data-id = {{$unit->id}}><i class="fa fa-indent text-white" aria-hidden="true"
                                              ></i></a>
                                        <a class="btn cus-b"  id="delete_unit" data-id="{{$unit->id}}"><i class="fa fa-trash text-white" aria-hidden="true"
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
    <script src="{{ asset('js/unit_handler.js') }}"></script>

    <script>
        $(function() {
            $("#brand_table").DataTable({
                "responsive": true,
                "autoWidth": false,
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
