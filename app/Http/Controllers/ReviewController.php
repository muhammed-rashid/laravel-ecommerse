<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store_review(Request $request){
       
        //check if the user is already rated this product 
        $alraedy_rated = review::where([
            ['product_id','=',$request->product_id],
            ['user_id','=',Auth::user()->id]
        ])->first();

        if($alraedy_rated){
            $alraedy_rated->review = $request->review;
            $alraedy_rated->rating_index = $request->index;
            $saved =  $alraedy_rated->save();
        }else{

            //if the user isnt already rated
            $review = new review();
            $review->review= $request->review;
            $review->user_id = Auth::user()->id;
            $review->product_id = $request->product_id;
            $review->rating_index = $request->index;
     
         
            $saved = $review->save();
        }


        

        if($saved){
            return response()->json([
                'status'=>'success',
                'message'=>'review is saved'
            ]);
        }

    }
}
