<?php

namespace App\Http\Controllers;

use App\Models\banner;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = banner::all();
        return view('admin-area.banner', ['banners' => $banners]);
    }
    public function add_banner(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'banner_heading' => 'required',
            'banner_description' => 'required',
            'banner_image' => 'required',
            'brand' => 'required'


        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => 'error',
                'message' => 'All field is required'
            ));
        }
        if ($request->banner_image == 'undefined') {
            return response()->json([
                'status' => 'error',
                'message' => 'Image is needed'
            ]);
        }


        $banner = new banner;

        $banner->banner_heading = $request->banner_heading;
        $banner->banner_description = $request->banner_description;
        $file = $request->banner_image;
        $icon = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/banners/'), $icon);
        $banner->banner_image_name = $icon;

        $banner->product_id = $request->brand;

        $save = $banner->save();

        if (!$save) {
            return response()->json(array(
                'status' => 'error',
                'message' => 'something went wrong please try again later'
            ));
        }

        return response()->json(array(
            'status' => 'success',
            'message' => 'You are successfully added a new banner',
            'data' => $banner
        ));
    }

    public function delete($id){
        $bann = banner::find($id);
        $deleted = $bann->delete($id);
        if ($bann->banner_image_name != "") {
            $image_path = public_path("img/banners/".$bann->banner_image_name."");
            unlink($image_path);
        }
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Banner is deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }
    }

