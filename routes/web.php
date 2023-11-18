<?php

use App\Http\Controllers\client\AccountController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckOutController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Client
Route::get('/', [HomeController::class,'index']);

Route::prefix('products')->group(function ()
{
    Route::get('/product/{id}', [ProductController::class,'show']);
    Route::post('/product/{id}', [ProductController::class,'postComment']);
    Route::get('/', [ProductController::class,'index']);
    Route::get('/category/{category_name}', [ProductController::class,'categories']);
    Route::get('/brand/{brand_name}', [ProductController::class,'brands']);
});

Route::prefix('cart')->group(function ()
{
    Route::post('/add', [CartController::class,'add']);
    Route::post('/update_cart', [CartController::class,'update']);
    Route::get('/delete/{rowId}', [CartController::class,'delete']);
    Route::get('/', [CartController::class,'index']);
});

Route::prefix('checkout')->group(function ()
{
    Route::post('/update_cart', [CartController::class,'update']);
    Route::get('/delete/{rowId}', [CartController::class,'delete']);
    Route::get('/', [CheckOutController::class,'index']);
    Route::post('/', [CheckOutController::class,'addOrder']);
    Route::get('/result', [CheckOutController::class,'result']);

    Route::get('/vnPayCheck', [CheckOutController::class,'vnPayCheck']);
});

Route::prefix('account')->group(function ()
{
    Route::get('/login', [AccountController::class,'login']);
    Route::post('/login', [AccountController::class,'checkLogin']);
    Route::get('/logout', [AccountController::class,'logout']);
    Route::get('/register', [AccountController::class,'register']);
    Route::post('/register', [AccountController::class,'postRegister']);

    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function ()
    {
        Route::get('/', [AccountController::class,'myOrderIndex']);
        Route::get('/{id}', [AccountController::class,'myOrderShow']);
    });

});


// Dashboard(Admin)
Route::prefix('admin')->middleware('CheckAdminLogin')->group(function (){
    Route::redirect('','admin/user');
    Route::resource('user', \App\Http\Controllers\admin\UserController::class);
    Route::resource('category',\App\Http\Controllers\admin\ProductCategoryController::class);
    Route::resource('brand',\App\Http\Controllers\admin\BrandController::class);
    Route::resource('product',\App\Http\Controllers\admin\ProductController::class);
    Route::resource('product/{product_id}/image',\App\Http\Controllers\admin\ProductImageController::class);
    Route::resource('product/{product_id}/detail',\App\Http\Controllers\admin\ProductDetailController::class);
    Route::resource('order',\App\Http\Controllers\admin\OrderController::class);

    Route::prefix('login')->group(function (){
        Route::get('',[\App\Http\Controllers\admin\HomeController::class,'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('',[\App\Http\Controllers\admin\HomeController::class,'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });
    Route::get('logout',[\App\Http\Controllers\admin\HomeController::class,'logout']);
});

/*Route::get('/', function (\App\Service\Product\ProductServiceInterface $productService){
    return $productService->find(1);
});*/
