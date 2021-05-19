<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_categories;
use App\Models\atributes;
use App\Models\Category;
use App\Models\images;
use App\Models\product;
use App\Models\Units;
use App\Models\product_features;
use App\Models\product_tags;
use Exception;
use Hamcrest\Arrays\IsArray;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {

        $products = product::with('categories', 'units')->get();


        return view('admin-area.products', ['products' => $products]);
    }

    public function add_product(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'product_title' => 'required',
            'Product_sub_title' => 'required',
            'categories' => 'required',
            'discription' => 'required',
            'unit' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'stock' => 'required',

        ]);

        if ($validator->fails()) {
            return 'error';
        }
        //validation over

        //starting saving
        $exist = product::where('product_name', '=', $request->product_title)->first();

        if ($exist != null) {
            return response()->Json([
                'status' => 'already exixt',
                'message' => 'this product is already exist'
            ]);
        }


        $x = true;
        $error = "";
        try {
            DB::transaction(function () use ($request) {
                $product = new product();
                //add object properties

                $product->product_name = $request->product_title;
                $product->product_sub_title = $request->Product_sub_title;
                $product->discription = $request->discription;
                $product->unit_id = $request->unit;
                $product->brand_id = $request->brand;
                $product->price = $request->price;
                $product->stock = $request->stock;
                $product->slug = str_replace(' ', '_', $request->product_title);

                $product->save();
                $product_id = $product->id;

                //image saving here

                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $saving_name = time() . str_replace(' ', '_', $filename);

                        //move file to the folder
                        $file->move(public_path('img/products'), $saving_name);

                        //saving to database

                        $image = new images();
                        $image->image_name = $saving_name;
                        $image->product_id = $product_id;

                        $image->save();
                    }
                }
                //inserting data to product categories
                if ($request->categories) {

                    foreach ($request->categories as $category_id) {
                        $category = new product_categories();

                        $category->category_id = $category_id;
                        $category->product_id = $product_id;

                        $category->save();
                    }
                }

                //save features table
                if ($request->attributes_ids) {
                    foreach ($request->attributes_ids as $index => $attribute) {
                        $feature = new product_features();

                        $feature->product_id = $product_id;
                        $feature->atribute_id = $attribute;
                        $feature->value = $request->attribute_values[$index];

                        $feature->save();
                    }
                }

                if ($request->tags) {
                    foreach ($request->tags as $tag) {
                        $tags = new product_tags();

                        $tags->product_id = $product_id;
                        $tags->tag_id = $tag;
                        $tags->save();
                    }
                }
            });
        } catch (\Exception $e) {
            $error = $e;
            $x = false;
        }
        if ($x) {
            return redirect()->action([ProductController::class, 'index']);
        } else {
            return response()->Json(['status' => 'fail','error'=>$error]);
        }
    }



    //delete product

    public function delete_product($id)
    {
        $product = product::find($id);
        $deleted = $product->delete($id);


        if (!$deleted) {
            return response()->Json([
                'status' => 'fail',
                'message' => 'something went wrong please try again later'
            ]);
        } else {
            return response()->Json(array(
                'status' => 'success',
                'message' => 'you are successfully deleted the product'
            ));
        }
    }
    //edit products

    public function edit_product($id)
    {


        $products = product::with('get_images', 'brands', 'units', 'categories', 'get_attr_value.get_val','get_tags')->find($id);

        return view('admin-area.edit_product', ['product' =>  $products]);
    }

    //delete product attribute frome database

    public function delete_product_attribute($id)
    {
        $product_feature = product_features::find($id);
        $deleted = $product_feature->delete($id);

        if (!$deleted) {
            return response()->Json([
                'status' => 'failed',
                'message' => 'something went wrong'
            ]);
        } else {
            return response()->Json(array(
                'status' => 'success',
                'message' => 'successfully deleted this feature'
            ));
        }
    }

    //delete image
    public function delete_image($id)
    {

        $image = images::find($id);
        $deleted = $image->delete($id);

        if ($deleted) {
            return response()->Json([
                'status' => 'success',
                'message' => 'image is deleted successfully'
            ]);
        } else {
            return response()->Json(array(
                'status' => 'fail',
                'message' => 'something went wrong'
            ));
        }
    }


    //upload a new image

    public function add_image(Request $request)
    {
        $product_id = $request->id;
        $file = $request->image;
        $icon = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/products'), $icon);

        $image = new images();
        $image->image_name = $icon;
        $image->product_id = $product_id;

        $save = $image->save();
        if (!$save) {
            return response()->Json([
                'status' => 'failed',
                'message' => 'something went wrong'
            ]);
        } else {
            return response()->Json([
                'status' => 'success',
                'message' => 'successfully added the image',
                'data' => $image
            ]);
        }
    }


    //update basic details

    public function update_basic_details(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'product_title' => 'required',
            'product_sub_title' => 'required',
            'categories' => 'required',
            'discription' => 'required',
            'unit' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        //validating inpuit
        if ($validator->fails()) {
            return response()->Json([
                'status' => 'error',
                'message' => 'All field is required'
            ]);
        }







        $error = "";
        $x = true;

        try {


            DB::transaction(function () use ($request) {
                $product_id = $request->product_id;


                $product = product::find($product_id);

                $product->product_name = $request->product_title;
                $product->product_sub_title = $request->product_sub_title;
                $product->discription = $request->discription;
                $product->stock = $request->stock;
                $product->unit_id = $request->unit;
                $product->price = $request->price;
                $product->brand_id = $request->brand;
                $product->slug = str_replace(' ', '_', $request->product_title);
                $product->save();

                //delete current categories
                product_categories::where('product_id', $request->product_id)->delete();

                //make array frome string
                $new_categories = explode(',', $request->categories);
                //adding new categories

                foreach ($new_categories as $cat) {
                    $category = new product_categories();
                    $category->category_id = $cat;
                    $category->product_id = $product_id;
                    $category->save();
                }
            });
        } catch (Exception $e) {
            $error = $e;
        }

        if ($x) {
            return response()->Json([
                'status' => 'success',
                'message' => 'You are successfully updated the product',

            ]);
        } else {
            return response()->Json(array(
                'status' => 'error',
                'message' => 'something went wrong'
            ));
        }
    }
    //update attributes
    public function update_product_atributes(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required',
            'attributes_ids' => 'required',
            'attribute_values' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->Json([
                'status' => 'error',
                'message' => 'One attribute is required for Update'
            ]);
        }
        $product_id = $request->product_id;
        //delete existing product features
        product_features::where('product_id', $product_id)->delete();

        //add new features

        foreach ($request->attributes_ids as $index => $atrid) {
            $feature = new product_features();
            $feature->product_id = $product_id;
            $feature->atribute_id = $atrid;
            $feature->value = $request->attribute_values[$index];
            $feature->save();
        }
        return response()->Json([
            'status' => 'success',
            'message' => 'You are successfully updated the features'
        ]);
    }

//update product tags
public function update_tags(Request $request){
    $validator = \Validator::make($request->all(),[
        'tags'=>'required'
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>'error',
            'messages'=>'Tags name is required'
        ]);
    }

    $product_id = $request->product_id;

    product_tags::where('product_id',$product_id)->delete();

    foreach($request->tags as $tag){
        $ta = new product_tags();
        $ta->tag_id = $tag;
        $ta->product_id = $product_id;
        $saved = $ta->save();
    }

    if(!$saved){
        return response()->json([
            'status'=>'error',
            'message'=>'something went wrong please try again'
        ]);
    }

    return response()->json([
        'status'=>'success',
        'message'=>'successfully updated tags'
    ]);


}




















}
