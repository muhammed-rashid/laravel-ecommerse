<?php

namespace App\Http\Controllers;


use App\Models\banner;
use App\Models\product;
use App\Models\brand;


use App\Models\ads;
use App\Models\offers;
use App\Models\order;
use Carbon\Carbon;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\review;

class FrontentController extends Controller
{
    public function index()
    {
      //return product::with('cart')->get();
        $banner = banner::All();
        $ads = ads::take(3)->get();
        $latest_product = product::with('get_images')->orderBy('id','desc')->get();

        $date = Carbon::now();
        $da = $date->toDateString();

        $offer_product = offers::with('product_frome_offer.get_images')->whereRaw('"'.$da.'" between `offer_start_at` and `offer_end_at`')->take(20)->get();



        return view('welcome', ['banner' => $banner,'ads'=>$ads,'latest_product'=>$latest_product,'offer'=>$offer_product]);
    }


    public function shop(Request $request)
    {
        // $data = Category::with('product_categories.get_brands.brands')->get();
        // return $data;


        $query = product::query();


        $query->when(request('sort') == 'new_arrival', function ($q) {
            return $q->orderBy('id', 'desc');
        });
        $query->when(request('sort') == ' ', function ($q) {
            return $q->orderBy('id');
        });
        $query->when(request('sort') == 'low_to_high', function ($q) {
            return $q->orderBy('price', 'asc');
        });
        $query->when(request('sort') == 'high_to_low', function ($q) {
            return $q->orderBy('price', 'desc');
        });
        $query->when(request('brands'), function ($q) use ($request) {


            return $q->whereHas('brands', function ($q) use ($request) {
                $q->whereIn('brand_name', $request->brands);
            });
        });
        $query->when(request('category'), function ($q) use ($request) {



            return $q->whereHas('categories', function ($q) use ($request) {
                $q->where('category',  $request->category);
            });
        });

        $products = $query->with('get_images', 'brands')->paginate(50);


        if ($request->ajax()) {
            return response()->json([
                'products' => $products,

            ]);
            // $view = view('frontent.product', compact('products'))->render();
            // return response()->json(['html' => $view]);
        }

        return view('frontent.shop', ['products' => $products]);
    }



    public function product($slug)
    {

        $product = product::where('slug', $slug)->with('get_images', 'brands', 'categories', 'units', 'get_attr_value.get_val', 'get_tags.all_tags.get_product.get_images','get_tags_name','get_reviews.reviewed_user')->first();
        //check if the product is purcahsed by this user for review
        if(Auth::user()){
          $query = order::query();
        $query->whereHas('get_order_details', function ($q) use($product){
            $q->where('product_id', $product->id);
        });
        //check the user is already purchased this one
        $ordered = $query->where('order_status','delivered')->first();

        }else{
            $ordered = null;
         }
       //calculte the total star rating
       $review_sum = review::where('product_id',$product->id)->avg('rating_index');
       $review_sum = round($review_sum);

    
///sreturn $product;

       
        return view('frontent.single_product', ['product' => $product,'ordered'=>$ordered,'rating'=>$review_sum]);
    }



















    public function get_brand_frome_category($cat)
    {
        $products = product::with('brands')->whereHas('categories', function ($q) use ($cat) {
            $q->where('slug', '=', $cat);
        })->get();
        $brands = $products->pluck('brands');




        return response()->json(array(
            'brands' => $brands,
            'status' => 'success'
        ));
    }

    public function categorised(Request $request,$slug)
    {

        $query = product::query();


        $query->when(request('sort') == 'new_arrival', function ($q) {
            return $q->orderBy('id', 'desc');
        });
        $query->when(request('sort') == 'low_to_high', function ($q) {
            return $q->orderBy('price');
        });
        $query->when(request('sort') == 'high_to_low', function ($q) {
            return $q->orderBy('price', 'desc');
        });



        $data = $query->whereHas('categories', function ($query) use($slug) {
            $query->where('category', $slug);
        })->with('get_images')->paginate(100);

        if ($request->ajax()) {





            return response()->json([
                'products' => $data,

            ]);
        }


        return view('frontent.categorised', ['data' => $data]);
    }



    //brandwise controller

    public function brandwise(Request $request, $slug)
    {
        $query = product::query();

        $query->when(request('sort') == 'new_arrival', function ($q) {
            return $q->orderBy('id', 'desc');
        });
        $query->when(request('sort') == 'low_to_high', function ($q) {
            return $q->orderBy('price');
        });
        $query->when(request('sort') == 'high_to_low', function ($q) {
            return $q->orderBy('price', 'desc');
        });
        $brand_wise_products = $query->with('brands', 'categories', 'get_images')->where('brand_id', $slug)->paginate(100);

        if ($request->ajax()) {





            return response()->json([
                'products' => $brand_wise_products,

            ]);
        }



        return view('frontent.brands', ['products' => $brand_wise_products]);
    }

    //offers are coming frome here
    public function offers(){
        $date = Carbon::now();
        $da = $date->toDateString();

        $result =  offers::whereRaw('"'.$da.'" between `offer_start_at` and `offer_end_at`')
        ->get();
        return $result;


    }

    //search routes
    public function search_control(Request $request){
        
        $param =$request->query('search');
        if($param){

      
       $product_name = product::where('product_name','like','%'.$param.'%')->limit(10)->get();
       return response()->json([
           'status'=>'success',
           'data'=>$product_name
       ]);
    } else{
        return response()->json([
            'status'=>'empty',
            
        ]);
    }   
   
    }

    //search redirect
    public function search(Request $request){
       $query = $request->query('q');
       $product = product::where('product_name','like','%'.$query.'%')->with('get_images')->get();
       return view('frontent.search',['search_result'=>$product]);
    }
}
