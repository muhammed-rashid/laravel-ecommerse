

@extends('layouts.admin_layout');
@section('content')
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

                    <form id="category_form">

                        @foreach (App\Models\atributes::all() as $attribute)
                            <div class="form-check">
                                <input class="form-check-input check-sel" type="checkbox" value="{{ $attribute->id }}"
                                    name="{{ $attribute->attribute }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $attribute->attribute }}
                                </label>
                            </div>
                        @endforeach





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn cus-b ed" id="add_attribute" value="Add" data-sub="submit" />
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end popup --}}



    <div class="card">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Basic Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Attributes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="false">Images</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="tags-tab" data-toggle="tab" href="#tags" role="tab" aria-controls="tags"
                    aria-selected="false">Product Tags</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <p class="error-update">error-something went wrong</p>
                
                <form class="mt-2 " method="POST" action="#" style="padding: 20px">
                    <input type="hidden" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Product Title</label>
                            <input type="text" class="form-control" name="product_title"
                                value="{{ $product->product_name }}" required>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Product Sub Title </label>
                            <input type="text" class="form-control" name="Product_sub_title"
                                value="{{ $product->product_sub_title }}" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Categories</label>
                            <select class="js-example-basic-multiple" name="categories[]" multiple="multiple" required>
                                @foreach (App\Models\Category::all() as $category)
                                  
                                        <option value="{{ $category->id }}">
                                            {{ $category->category }}</option>
                             







                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="col-md-12 mb-3">
                            <label>Discription</label>
                            <textarea name="discription" id="" rows="10" style="width: 100%"
                                required>{{ $product->discription }}</textarea>
                        </div>
                        <hr>



                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Unit</label>
                                <select class="form-control" name="unit" required>
                                    @foreach (App\Models\Units::all() as $unit)


                                        <option {{ $unit->id == $product->units->id ? 'selected' : '' }} value="{{ $unit->id }}">
                                            {{ $unit->unit }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Brand</label>
                               
                                <select class="form-control" name="brand" required>
                                    @foreach (App\Models\brand::all() as $brand)
                                   
                                        <option {{ $brand->id == $product->brand_id ? 'selected' : '' }} value="{{ $brand->id }} ">
                                            {{ $brand->brand_name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="exampleInputEmail1" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}" required>

                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="exampleInputPassword1" class="form-label">Stock</label>
                            <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" required>
                        </div>






                    </div>


                    <input type="submit" class="btn cus-b" value="Update" id="update_basic_details">
                </form>






            </div>
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="error-update-at"></p>
                
                <form class="mt-2" method="POST" style="padding: 20px" action="/admin/update-product-attributes" id="at-for">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}" />
                    <div class="row">

                        @if (count($product->get_attr_value) > 0)
                            @foreach ($product->get_attr_value as $index => $attr)
                                <div class="attri-listing col-md-12">

                                    <div style="margin-bottom:5px" class="row">
                                        <div class="col-md-2">
                                            {{ $attr->get_val->attribute }}
                                            <input type="hidden" name="attributes_ids[]" value="{{$product->get_attr_value[$index]->atribute_id}}" />
                                        </div>
                                        <div class="col-md-1">--</div>
                                        <div class="col-md-4">
                                            <input type="text" name="attribute_values[]" value="{{$attr->value}}"
                                                style="width:100%;border:1px solid #d8d8d8;">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger" id="delete_attribute_also_db" data-id="{{$attr->id}}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="attributes mt-5 col-md-12">
                            <p>Add Attributes<i class="fa fa-plus" aria-hidden="true" id="add_attr_pop"></i></p>
                        </div>

                    </div>









                    <input type="submit" class="btn cus-b" value="Update Attributes" id="update_product_attributes">
                </form>



            </div>
            <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form class="mt-2 " method="POST" action="#" style="padding: 20px" enctype="multipart/form-data">
                   
                    <div class="row" id="image_list">






                        <div class="mb-3 col-md-2">
                            <label for="image" class="form-label"><img
                                    src="https://static.thenounproject.com/png/558475-200.png" /></label>
                            <input class="form-control" type="file" id="image" name="image" multiple>
                        </div>
                        @if (count($product->get_images) > 0)
                                @foreach ($product->get_images as $image)
                        <div class="mb-3 col-md-2">
                            
                                    <div class="inner-img-con">
                                        <img src="{{ asset('img/products/' . $image->image_name . '') }}"  />
                                        <i class="fa fa-trash" data-id = "{{$image->id}}" id="delete_images_frome_edit"></i>
                                    </div>
                               
                        </div>
                        @endforeach

                        @endif








                    </div>

                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="csrf">
                    <input type="hidden" name="id" value="{{$product->id}}" id="id">

                    <input type="submit" class="btn cus-b" value="Add Image" id="add_extra_image">
                </form>


            </div>




            <div class="tab-pane fade " id="tags" role="tabpanel" aria-labelledby="tags-tab">
                <div class="wd ml-3 mt-3"></div>
                <form class="mt-2 " method="POST" action="#" style="padding: 20px" id="tags_update">
                   
                    
                    <div class="form-group col-md-6">
                        <label>Tags</label>
                        <select class="tags" name="tags[]" multiple="multiple" required>
                            @foreach (App\Models\tags::all() as $tags)
                               
                                      <option  value="{{ $tags->id }}">{{ $tags->tag_name }}</option>
                            

                                  
                             

                            @endforeach
                        </select>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" id="csrf">
                        <input type="hidden" name="product_id" value="{{$product->id}}" id="id">
    
                        <input type="submit" class="btn cus-b mt-5" value="Update tags" id="update_tags">


                    </div>
                 
                </form>


            </div>






















        </div>
    </div>





@endsection
@section('scripts')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{ asset('js/product_handler.js') }}"></script>
    <script>
        CKEDITOR.replace('discription');

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'select categorys',
                width: '100%',

            });
            $('.tags').select2({
                placeholder: 'select Tags',
                width: '100%',

            });
        });

    </script>

@endsection
