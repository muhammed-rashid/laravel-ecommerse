@extends('layouts.admin_layout');
@section('content')







<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Customers</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column ascending">ID
                                </th>
                                
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Email</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                                    Mobile Number</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Joined On</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Role</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Is verified</th>
                                
                               

                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="action: activate to sort column ascending">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

@foreach ($user as $users)
    


                            <tr role="row" class="odd">
                                <td class="" tabindex="0">{{$users->id}}</td>
                                <td>{{$users->email}}</td>
                                <td>{{$users->phone}}</td>
                                <td class="">{{date('d-m-Y', strtotime($users->Joined_on))}}</td>
                                <td>{{$users->role}}</td>
                             
                                <td>{{$users->email_verified_at != null?'Verified User' : 'Un Verified User'}}</td>
                              
                                <td>
                                    <a href="/admin/view-customer/" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_customer"></i></a>
                                    <a href="" class="btn cus-b"  data-id = "" id="delete_customer"><i class="fa fa-trash" aria-hidden="true"></i></a>
                               
                                   
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/customer_handler.js') }}"></script>

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
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>

    @endsection