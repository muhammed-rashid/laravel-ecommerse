<?php

namespace App\Http\Controllers;

use App\Models\product_tags;
use Illuminate\Support\Facades\Input;
use App\Models\tags;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input as InputInput;

class TagsController extends Controller
{
    public function index(Request $request){
        $tags = tags::all();
        
        return view('admin-area.tags',['tags'=>$tags]);
    }
    public function add_tag(Request $request){
        $validator = \Validator::make($request->all(),[
            'tag_name'=>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'error',
                'message'=>'tag name is required'
            ]);
        }

        $tag = new tags();
        $tag->tag_name = $request->tag_name;
        $tag->tag_slug = str_replace(' ','_',$request->tag_name);
        $saved = $tag->save();

        if(!$saved){
            return response()->json([
                'status'=>'error',
                'message'=>'something went wrong'
            ]);
        }else if($saved){
            return response()->json([
                'status'=>'success',
                'message'=>'successfully added new tag'
            ]);
        }
    }
    public function update_tag(Request $request){
        $validator = \Validator::make($request->all(),[
            'tag_name'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
                'message'=>'Tage Name is required'
            ]);
        }

        $tag = tags::find($request->tag_id);
       $tag->tag_name = $request->tag_name;
       $tag->tag_slug = str_replace(' ','_',$request->tag_name);
       $saved = $tag->save();

       if(!$saved){
           return response()->json([
               'status'=>'error',
               'message'=>'Something went wrong please try again'
           ]);
       }

       return response()->json([
           'status'=>'success',
           'message'=>'Successfully updated the tag'
       ]);
    }

    //delete tag ajax request enter here
    public function delete_tag($id){
        $tag = tags::find($id);
        $deleted = $tag->delete();

        if(!$deleted){
            return response()->json(array(
                'status'=>'error',
                'message'=>'something went wrong'
            ));
        }

        return response()->json([
            'status'=>'success',
            'message'=>'deleted successfully'
        ]);
    }
}
