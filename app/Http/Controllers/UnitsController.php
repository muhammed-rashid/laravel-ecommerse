<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Units;

class UnitsController extends Controller
{
    public function units()
    {
       
        $units = Units::all();
        return view('admin-area.units', ['units' => $units]);
    }
    public function add_unit(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'unit' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'unit name is required',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $unit = new Units();
        $unit->unit = $request->unit;
        $unit->slug = str_replace(' ','_',$request->unit);

        $save = $unit->save();

        if(!$save){
            return response()->Json([
                'status' => 'fail',
                'message'=>'some thing went wrong please try again'
            ]);
        }else{
            return response()->Json(array(
                'status'=>'success',
                'message'=>'unit added successfully',
                'data'=>$unit
            ));
        }
        
    }
    //edit unit

    public function edit_unit(Request $request){
        $validator = \Validator::make($request->all(),[
            'unit'=>'required'
        ]);

        if($validator->fails()){
            return response()->Json(array(
                'status'=>'error',
                'message'=>'unit name is required',
                'errors'=>$validator->getMessageBag()->toArray()
            ));
        }

        $unit = Units::find($request->id);
        $unit->unit = $request->unit;
        $unit->slug = str_replace(' ','_',$request->unit);
        $save = $unit->save();

        if(!$save){
            return response()->Json([
                'status'=>'fails',
                'message'=>'something went wrong please try again'
            ]);
        }else{
            return response()->Json([
                'status'=>'success',
                'message'=>'category updated successfully',
                'data'=>$unit
            ]);
        }
    }
    //delete unit
    public function delete_unit($id){
        $unit = Units::find($id);
        $deleted = $unit->delete($id);

        if(!$deleted){
            return response()->Json([
                'status'=>'error',
                'message'=>'something went wrong'
            ]);
        }else{
            return response()->Json([
                'status'=>'success',
                'message'=>'successfully deleted the unit'
            ]);
        }
    }
}
