<?php

namespace App\Http\Controllers;

use App\Models\atributes;

use Illuminate\Http\Request;

class AtributesController extends Controller
{
    public function index()
    {
        $attributes = atributes::all();
        return view('admin-area.properties', ['attributes' => $attributes]);
    }

    public function add_attribute(Request $request)
    {

        $validator = \Validator::make($request->all(), array(
            'attribute' => 'required'
        ));
        if ($validator->fails()) {
            return response()->Json(array(
                'status' => 'error',
                'message' => 'Attribute name is required',
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        $attribute = new atributes();
        $attribute_name = $request->attribute;
        $slug =  str_replace(' ', '_', $request->attribute);
        $attribute->attribute = $attribute_name;
        $attribute->slug = $slug;

        $save = $attribute->save();
        if (!$save) {
            return response()->Json(array(
                'status' => 'fail',
                'message' => 'something went wrong',

            ));
        } else {
            return response()->Json(array(
                'status' => 'success',
                'message' => 'New attribute added successfully',
                'data' => $attribute
            ));
        }
    }
    public function edit_attribute(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'attribute' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => 'error',
                'message' => 'category name is required',
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        $attribute = atributes::find($request->id);
        $attribute->attribute = $request->attribute;
        $attribute->slug =  str_replace(' ', '_', $request->attribute);

        $save = $attribute->save();
        if (!$save) {
            return response()->json(array(
                'status' => 'fail',
                'message' => 'something went wron pleese try again'
            ));
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'succesfully updated the field',
                'data' => $attribute
            ]);
        }
    }
    //delete attribute
    public function delete_attribute($id)
    {

        $attribute = atributes::find($id);
        $deleted = $attribute->delete($id);

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => ' is deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }
}
