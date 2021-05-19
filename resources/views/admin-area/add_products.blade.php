@extends('layouts.admin_layout')
@section('content')

    <div class="container-fluid pt-5">
        {{-- popup --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Attributes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form  id="category_form">

                            @foreach (App\Models\atributes::all() as $attribute)
                            <div class="form-check">
                                <input class="form-check-input check-sel" type="checkbox" value="{{$attribute->id}}" name="{{$attribute->attribute}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  {{$attribute->attribute}}
                                </label>
                            </div>
                            @endforeach
                           
                             



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cus-b" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn cus-b ed" id="add_attribute" value="Add"
                            data-sub="submit" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end popup --}}


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Add Product</h3><br>

                        <form class="mt-2" method="POST" action="/admin/add-products" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" name="product_title" required>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Product Sub Title </label>
                                    <input type="text" class="form-control" name="Product_sub_title" required>
                                </div>


                                <div class="form-group col-md-6">
                                    <label>Categories</label>
                                    <select class="js-example-basic-multiple" name="categories[]" multiple="multiple" required>
                                        @foreach (App\Models\Category::all() as $category)
                                                
                                          
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                            
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tags</label>
                                    <select class="tags" name="tags[]" multiple="multiple" >
                                        @foreach (App\Models\tags::all() as $tag)
                                                
                                          
                                            <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                            
                                            @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="col-md-12 mb-3">
                                    <label>Discription</label>
                                    <textarea name="discription" id="" rows="10" style="width: 100%" required></textarea>
                                </div>
                                <hr>
                            <div class="attri-listing col-md-12">


                            </div>
                            <div class="attributes mt-5 col-md-12">
                                <p>Add Attributes<i class="fa fa-plus" aria-hidden="true" id="add_attr_pop"></i></p>
                            </div>


                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control" name="unit" required>
                                            @foreach (App\Models\Units::all() as $unit)
                                                
                                          
                                            <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control" name="brand" required>
                                            @foreach (App\Models\brand::all() as $brand)
                                                
                                          
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="exampleInputEmail1" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" required>

                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="exampleInputPassword1" class="form-label">Stock</label>
                                    <input type="text" class="form-control" name="stock" required>
                                </div>






                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label"><img src="https://www.ipabp.org/bundles/faraipgis/images/default_thumbnail.jpg" style="width: 300px"></label>
                                <input class="form-control" type="file" id="formFileMultiple" name="images[]" multiple>
                              </div>
                            

                            <input type="submit" class="btn cus-b" value="Add Product">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{asset('js/product_handler.js')}}"></script>
    <script>
        CKEDITOR.replace('discription');

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'select categorys',
                width: '100%',

            });
            $('.tags').select2({
                placeholder: 'select tags',
                width: '100%',

            });
        });

    </script>

@endsection
