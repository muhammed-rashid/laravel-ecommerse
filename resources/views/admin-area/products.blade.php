@extends('layouts.admin_layout')
@section('content')
    <div class="row pt-3 ml-1">
        <a href="/admin/add-products" class="btn cus-b">
            Add Product
        </a>
    </div>

  
    



    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
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
                                        aria-label="Browser: activate to sort column ascending">Product Title</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Product Sub Title</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                                        Price</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Category</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">unit</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending">Stock</th>
                                   

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="action: activate to sort column ascending">Actions</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
@foreach ($products as $product)
    

                                <tr role="row" class="odd">
                                    <td class="" tabindex="0">{{$product->id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_sub_title}}</td>
                                    <td class="sorting_1">{{$product->price}}</td>
                                    <td>@foreach ($product->categories as $cat)
                                        <span class="categ">{{$cat->category}}</span>
                                    @endforeach</td>
                                    <td>{{$product->units->unit}}</td>
                                    <td>{{$product->stock}}</td>
                                  
                                    <td>
                                        <a href="/admin/edit-product/{{$product->id}}" class="btn cus-b" ><i class="fa fa-eye" aria-hidden="true" id="view_product"></i></a>
                                        <a href="" class="btn cus-b"  data-id = "{{$product->id}}" id="delete_product"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   
                                       
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
    <script src="{{ asset('js/product_handler.js') }}"></script>

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
