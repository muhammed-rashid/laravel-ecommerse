<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AtributesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\FrontentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\order_admin_controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\wishlistController;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
//use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;





Route::group(['middleware' => ['AdminAccess']], function () {
   Route::get('/admin',[dashboard::class,'index']);
    //category routes
    Route::get('/admin/category', [CategoryController::class, 'showcategory']);
    Route::post('/admin/addcategory', [CategoryController::class, 'addCategory']);
    Route::post('/admin/editcategory', [CategoryController::class, 'editCategory']);
    Route::get('/admin/deletecategory/{id}', [CategoryController::class, 'deleteCategory']);

    //brand routes
    Route::get('/admin/brands', [BrandController::class, 'index']);
    Route::post('/admin/add_brand', [BrandController::class, 'add_brand']);
    Route::post('/admin/edit_brand', [BrandController::class, 'edit_brand']);
    Route::get('/admin/deletebrand/{id}', [BrandController::class, 'deletebrand']);

    //attributes routes
    Route::get('/admin/atributes', [AtributesController::class, 'index']);
    Route::post('/admin/add_atribute', [AtributesController::class, 'add_attribute']);
    Route::post('/admin/edit_atribute', [AtributesController::class, 'edit_attribute']);
    Route::get('/admin/delete_atribute/{id}', [AtributesController::class, 'delete_attribute']);
    //unit routes
    Route::get('/admin/units', [UnitsController::class, 'units']);
    Route::post('/admin/add_unit', [UnitsController::class, 'add_unit']);
    Route::post('/admin/edit_unit', [UnitsController::class, 'edit_unit']);
    Route::get('/admin/delete_unit/{id}', [UnitsController::class, 'delete_unit']);
    //products routes
    Route::get('/admin/products', [ProductController::class, 'index']);
    Route::get('/admin/add-products', function () {
        return view('admin-area.add_products');
    });

    Route::post('/admin/add-products', [ProductController::class, 'add_product']);
    Route::get('/admin/delete-product/{id}', [ProductController::class, 'delete_product']);
    //edit product
    Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit_product']);
    //delete image
    Route::get('/admin/edit/delete_image/{id}', [ProductController::class, 'delete_image']);
    //upload a new image
    Route::post('/admin/product/add-image', [ProductController::class, 'add_image']);
    //delete atribute
    Route::get('/admin/delete-product-attribute/{id}', [ProductController::class, 'delete_product_attribute']);
    //update basic details of products
    Route::post('/admin/product/update-basic', [ProductController::class, 'update_basic_details']);
    //update attributes of products

    Route::post('/admin/update-product-attributes', [ProductController::class, 'update_product_atributes']);

    //update tags of products
    Route::post('/admin/update_product_tags', [ProductController::class, 'update_tags']);

    //user managment routes***************
    //******************************
    Route::get('/admin/customers', [customerController::class, 'get_all_customer']);

    //banner routes
    Route::get('/admin/banner', [BannerController::class, 'index']);
    //add banners
    Route::post('/admin/banner', [BannerController::class, 'add_banner']);
    Route::get('/admin/banner-delete/{id}', [BannerController::class, 'delete']);
    //orders admin page
    Route::get('/admin/orders', [order_admin_controller::class, 'index']);
    Route::get('/admin/order/update-order-status/{status}/{order_id}', [order_admin_controller::class, 'update_order_status']);
    Route::get('/admin/order/order_review/{order_id}', [order_admin_controller::class, 'order_review']);
    Route::get('/admin/order/status', [order_admin_controller::class, 'order_status_result']);


    //settings news
    Route::get('/admin/settings', [GeneralSettingsController::class, 'index']);
    Route::post('/admin/settings', [GeneralSettingsController::class, 'save_settings']);

    //tags routes

    Route::get('/admin/tags', [TagsController::class, 'index']);
    Route::post('/admin/tags', [TagsController::class, 'add_tag']);
    Route::post('/admin/update_tags', [TagsController::class, 'update_tag']);
    Route::get('/admin/delete-tag/{id}', [TagsController::class, 'delete_tag']);

    //ads routes

    Route::get('/admin/ads', [AdsController::class, 'index']);
    Route::post('/admin/ads', [AdsController::class, 'add_an_ad']);
    Route::get('/admin/delete_ad/{id}', [AdsController::class, 'delete_ad']);

    //get all products to map in ads area

    Route::get('/admin/get_all_product', [AdsController::class, 'get_all_products']);
    //offers
    Route::get('/admin/offers', [offerController::class, 'index']);
    Route::post('/admin/offers', [offerController::class, 'add_offer']);
    Route::get('/admin/delete_offer/{id}', [offerController::class, 'delete_offer']);
});


////////////////////Frontent routes////////////////////////


Route::get('/register', [userController::class, 'getRegister']);

Route::post('/register', [userController::class, 'register']);


Route::get('/email/veri', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {


    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

//resend verification email


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//login routes
Route::get('/login', [userController::class, 'getLogin'])->name('login');
Route::post('/login', [userController::class, 'login']);

Route::get('/logout', [userController::class, 'doLogout']);
//end of login routes
//password reset routes starts here

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->middleware('guest')->name('password.request');


//handling input

Route::post('/forgot-password', [userController::class, 'forgot_password'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
//saving reseted password


Route::post('/reset-password', [userController::class, 'reset_password'])->middleware('guest')->name('password.update');


//frontent routes
Route::get('/', [FrontentController::class, 'index']);
Route::get('/get_product_name_search',[FrontentController::class,'search_control']);
Route::get('/search',[FrontentController::class,'search']);
//shop page routes
Route::get('/shop', [FrontentController::class, 'shop']);
Route::get('/product/{slug}', [FrontentController::class, 'product']);
Route::get('/get-brand-frome-cat/{cat}', [FrontentController::class, 'get_brand_frome_category']);
//categorised product view
Route::get('/category/{slug}', [FrontentController::class, 'categorised']);
//brand wise view

Route::get('/{id}/brands', [FrontentController::class, 'brandwise']);


//cart routes
Route::group(['middleware' => ['is_logged_in','email_verified']], function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/add_to_cart/{id}', [CartController::class, 'add_to_cart']);
    Route::get('/delete_cart_item/{id}', [CartController::class, 'delete_cart']);
    Route::get('update_cart/{id}/{qty}', [CartController::class, 'update_cart']);
    //checkout routes
    Route::get('/order', [orderController::class, 'get_order_page']);
    //adress routes
    Route::post('/add_address', [OrderController::class, 'add_address']);
    Route::get('/edit_adress/{id}',[orderController::class,'edit_get']);
    Route::post('/update_adress',[orderController::class,'update_adress']);
    Route::get('/delete_adress/{id}',[orderController::class,'delete_adress']);
    //wishlist
    Route::get('/wishlist',[wishlistController::class,'index']);
    Route::get('/add_wishlist/{id}',[wishlistController::class,'add_to_wishlist']);
    Route::get('/delete_wishlist/{id}',[wishlistController::class,'delete_wishlist']);
    //order
    Route::post('/place_order',[OrderController::class,'place_order']);
    Route::get('/my-orders',[OrderController::class,'my_orders']);
    Route::get('/cancel-order/{order_id}',[OrderController::class,'cancel_order']);
//payment
  

    Route::get('/verify_payment',[OrderController::class,'verify']);
    Route::get('/payment-failed',[OrderController::class,'order_failed']);
 

    Route::get('/add_review',[ReviewController::class,'store_review']);
});
