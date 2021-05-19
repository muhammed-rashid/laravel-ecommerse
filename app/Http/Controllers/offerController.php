<?php

namespace App\Http\Controllers;

use App\Models\offers;
use Illuminate\Http\Request;

class offerController extends Controller
{
    public function index(){
       $offer=offers::with('product_frome_offer')->get();
         return view('admin-area.offers',['offers'=>$offer]);
    }
    public function add_offer(Request $request){
        
        $validator=\Validator::make($request->all(),array(
            'End_date'=>'required',
            
            'offer_price'=>'required',
            'product'=>'required',
            'start_date'=>'required',
        ));

        if ($validator->fails()){
            return response()->json([
                'status'=>'error',
                'message'=>'all field required',
               
            ]);
        }

        $offer = new offers();
        $offer->offer_percentage = $request->offer_price;
        $offer->offer_start_at	 = $request->start_date;
        $offer->offer_end_at = $request->End_date;
        $offer->product_id = $request->product;

        $saved = $offer->save();

        if(!$saved){
            return response()->json(array(
                'status'=>'error',
                'message'=>'Something went wrong please try again'
            ));
        }
        return response()->json(array(
            'status'=>'success',
            'message'=>'successfully Added new offer'
        ));
    }

    public function delete_offer($id){
        $deleted = offers::where('id',$id)->delete();
        if(!$deleted){
            return response()->json([
                'status' => 'error',
                'message'=>'Something went wrong'
            ]);
        }
        return response()->json([
            'status'=>'success',
            'message'=>'deleted successfully'
        ]);
    }


}
