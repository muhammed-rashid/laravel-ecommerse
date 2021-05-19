<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        $ads = ads::all();
        return view('admin-area.ads', ['ads' => $ads]);
    }

    //add an ad
    public function add_an_ad(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'ad_description' => 'required',
            'ad_heading' => 'required',
            'ad_image' => 'required',
            'product' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray(),
                'message' => 'All Field is required'
            ]);
        }
        if ($request->hasFile('ad_image')) {
            $file = $request->ad_image;
            $icon = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/ads/'), $icon);
        }

        $ad = new ads();
        $ad->ad_heading = $request->ad_heading;
        $ad->ad_discription = $request->ad_description;
        $ad->product_slug = $request->product;
        $ad->image_name = $icon;
        $saved = $ad->save();
        if (!$saved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'succesfully added new ad'
        ]);
    }



    //getting all products to frontent

    public function get_all_products()
    {
        $products = product::all('id','slug', 'product_name');

        return response()->json([
            'status' => 'success',
            'message' => 'successfully fetched data frome database',
            'data' => $products,
        ]);
    }
//delete ad
public function delete_ad($id){
    $ad = ads::find($id);
    $image_name = $ad->image_name;
    $image_path = public_path("img/ads/".$image_name."");
            unlink($image_path);

            $deleted = $ad->delete();

            if(!$deleted){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Something went wrong'
                    
                ]);
            }
            return response()->json([
                'status'=>'success',
                'mesage'=>'successfully deleted the ad'
            ]);
    
}














}
