<?php

use App\Http\Controllers\Api\V1\Shop\AuthController;
use App\Http\Controllers\Api\V1\Shop\Product\BiggestDiscountProductController;
use App\Http\Controllers\Api\V1\Shop\Product\MostViewProductController;
use App\Http\Controllers\Api\V1\Shop\Product\ProductController;
use App\Http\Controllers\Api\V1\Shop\Product\ProductProductItemController;
use App\Http\Controllers\Api\V1\Shop\Product\SpecialProductOfferController;
use App\Http\Controllers\Api\V1\Shop\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('test', function () {
    return \App\Models\ProductItem::saleable()->biggestDiscountProductId()->limit(5)->get()->pluck('product_id')->toArray();
    $product = \App\Models\Product::orderBy('discount')->limit(5)->get();
    return $product;
    return \App\Models\Seller::saleable()->count();
    return \App\Models\Brand::saleable()->count();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('auth-user', [AuthController::class, 'getAuthUser'])->name('auth.user')->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('users', UserController::class);
});

Route::apiResource('products', ProductController::class)->only(['show', 'index']);
Route::get('
/{product}', [ProductProductItemController::class, 'show']);
Route::get('special-product', [SpecialProductOfferController::class, 'index']);
Route::get('most-view-product', [MostViewProductController::class, 'index']);
Route::get('big-discount-product', [BiggestDiscountProductController::class, 'index']);
