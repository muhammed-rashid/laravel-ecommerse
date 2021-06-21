<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;
use App\Models\product;
use App\Models\product_categories;
use GrahamCampbell\ResultType\Success;

class BrandController extends Controller
{
    public function index()
    {
      
       
        $Brands = brand::all();
        return view('admin-area.brands', ['brands' => $Brands]);
    }
    public function add_brand(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'brand' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => 'error',
                'message' => 'Brand name field is required',
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        $brand = new brand;
        $slug = str_replace(' ', '_', $request->brand);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $icon = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/brands/'), $icon);
            $brand->icon = $icon;
        }
        $brand->brand_name = $request->brand;
        $brand->slug = $slug;
        $saved = $brand->save();
        if (!$saved) {
            return response()->json(array(
                'status' => 'fail',
                'message' => 'something went wrong to inset'
            ));
        } else {
            return response()->json(array(
                'status' => 'success',
                'message' => 'successfully added a new brand',
                'data' => $brand
            ));
        }


        return response()->json(array(
            'data' => $request->brand,
            'image' => $request->image
        ));
    }

    //edit brand controller
    public function edit_brand(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'brand' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Brand name field is required',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $brand = brand::find($request->id);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $icon = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/brands'), $icon);
            if ($brand->icon) {
                $image_path = public_path("img/brands/{$brand->icon}");
                unlink($image_path);
            }
            $brand->icon = $icon;
        }
        $slug =  str_replace(' ', '_', $request->brand);
        $brand->slug = $slug;
        $brand->brand_name = $request->brand;
        $save = $brand->save();
        if (!$save) {
            return response()->json([
                "status" => "fail",
                "message" => "some thing went wrong pleese try again"
            ]);
        } else {
            return response()->json(array(
                "status" => "success",
                "message" => "Successfully updated the brand",
                "data" => $brand
            ));
        }
    }

    //delete brand 

    public function deletebrand($id)
    {
        $brand = brand::find($id);
        $deleted = $brand->delete($id);
        if ($brand->icon != "") {
            $image_path = public_path("img/brands/{$brand->icon}");
            unlink($image_path);
        }
        if ($deleted) {
          
            return response()->json([
                'status' => 'success',
                'message' => 'category is deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }
}
