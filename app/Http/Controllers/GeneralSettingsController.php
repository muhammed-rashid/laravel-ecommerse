<?php

namespace App\Http\Controllers;

use App\Models\generalDetails;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    public function index(){
        $basic_details = generalDetails::first();
       
        return view('admin-area.settings',['basic_details'=>$basic_details]);
    }

    public function save_settings(Request $request){

 if($request->id != null ){
    $details = generalDetails::find($request->id);
    $details->delivery_charge = $request->delivery_charge;
    $details->min_order_amount = $request->Min_order_amount;
    $details->support_whatsapp_number = $request->support_whatsapp_number;
    $details->support_email = $request->support_email;
    $details->store_adress = $request->store_adress;
    $saved = $details->save();
    if(!$saved){
        return response()->json(array(
            'status'=>'error',
            'message'=>'Something Went Wrong Please try again!'
        ));
    }
    return response()->json(array(
        'status'=>'success',
        'message'=>'Basic details updated succesfully !'
    ));
 }

        $details = new generalDetails();
        $details->delivery_charge = $request->delivery_charge;
        $details->min_order_amount = $request->Min_order_amount;
        $details->support_whatsapp_number = $request->support_whatsapp_number;
        $details->support_number = $request->support_number;
        $details->support_email = $request->support_email;
        $details->store_adress = $request->store_adress;
        $saved = $details->save();
        if(!$saved){
            return response()->json(array(
                'status'=>'error',
                'message'=>'Something Went Wrong Please try again!'
            ));
        }
        return response()->json(array(
            'status'=>'success',
            'message'=>'Basic details Added succesfully !'
        ));
    }
}
