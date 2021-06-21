<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => "error",
                'message' => 'category name is required',
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        $category = new Category();
        $slug =  str_replace(' ', '_', $request->category);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $icon = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/category'), $icon);
            $category->icon = $icon;
        }

        $category->category = $request->category;
        $category->slug = $slug;

        $saved = $category->save();
        $id = $category->id;

        if (!$saved) {
            return response()->json(array(
                'status' => "fail",
                'message' => "some thing went wrong"
            ));
        } else {
            return response()->json(array(
                'status' => "success",
                'message' => "New category created successfully",
                'data' => $category,

            ));
        }
    }
    //show category in dashboard
    public function showcategory()
    {
        $category = Category::all();

        return view('admin-area.category', ['category' => $category]);
    }

    //edit request enter here
    public function editCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => 'error',
                'message' => 'Category name is required',
                'errors' => $validator->getMessageBag()->toArray()

            ));
        }

        $category = Category::find($request->id);
        $slug =  str_replace(' ', '_', $request->category);
        $category->category = $request->category;
        $category->slug = $slug;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $icon = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/category'), $icon);
            if ($category->icon) {
                $image_path = public_path("img/category/{$category->icon}");
                unlink($image_path);
            }
            $category->icon = $icon;
        }
        $saved = $category->save();
        if (!$saved) {
            return response()->json(array(
                'status' => "fail",
                'message' => "some thing went wrong"
            ));
        } else {
            return response()->json(array(
                'status' => "success",
                'message' => "category updated successfully",
                'data' => $category,

            ));
        }
    }

    public function deleteCategory($id)
    {
        $Users = Category::find($id);

       
        

        $deleted = $Users->delete($id);
        if ($Users->icon != "") {
            $image_path = public_path("img/category/{$Users->icon}");
            unlink($image_path);
        }
        if ($deleted) {
            //delete the related product




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
