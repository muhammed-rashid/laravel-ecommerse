@extends('layouts.frontent-layout')

@section('content')
    




<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-shop spad">
    <div class="container">
        <form method="get" action="?" id="sorting_form">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
             
                        @foreach (get_all_categories() as $category)
                        <input type="radio" id="categories" name="category" value="{{$category->slug}}">
                        <label for="category">{{$category->category}}</label><br>
                        @endforeach
                     
                      
                  
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title th-tit"></h4>
                    <div class="fw-brand-check">
                        <div class="bc-item brands-list">
                           
                         
                        </div>
                        
                        
                        
                    </div>
                </div>
               
               
                
                
               
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting" name="sort">
                                   
                            
                                    <option value="low_to_high" >Low to High</option>
                                    <option value="high_to_low" >High to Low</option>
                                    <option value="new_arrival" >New Arrival</option>
                                </select>
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="product-list">
                    <div class="row product_list append_pro">
                        @include('frontent.product')
                      
                        
                        
                        
                      
                       
                    </div>
                    
                </div>
                <div class="overlay">
                    <div class="loading_icon">
                        <img src="https://www.eurobitume.eu/fileadmin/generic/pits_downloadcenter/Resources/Public/images/loading.gif" alt="" srcset="">
                    </div>
                </div>
            </form>

































            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    var products = @json($products)
</script>




 <script src="{{asset('js/frontent/productsHandler.js')}}"></script> 
 
 <script src="{{asset('js/frontent/cart.js')}}"></script>   
@endsection