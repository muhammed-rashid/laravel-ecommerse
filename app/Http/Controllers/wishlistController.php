<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\wishlist;

class wishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $wishlist_data = wishlist::with('get_products.get_images')->where('user_id', '=', Auth::user()->id)->get();
            return view('frontent.wishlist', ['wishlist' => $wishlist_data]);
        }
    }
    public function add_to_wishlist($id)
    {

        if (Auth::Check()) {
            $user_id = Auth::user()->id;
            $product_id = $id;

            $already_exist = wishlist::where([
                ['user_id', '=', $user_id],
                ['product_id', '=', $product_id]
            ])->first();

            if ($already_exist != null) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'successfully added'
                ]);
            }





            $wishlist = new wishlist();
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $product_id;
            $saved = $wishlist->save();
            if (!$saved) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Item added to wishlist'
            ]);
        }
    }

    public function delete_wishlist($id){
      $item = wishlist::find($id)->delete();
      return response()->json([
          'status'=>'success',
          'message'=>'deleted wishlist'
      ]);
      
    }
}
