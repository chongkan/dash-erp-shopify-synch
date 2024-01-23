<?php

use Illuminate\Support\Facades\Route;
use Modules\ShopifySync\Http\Controllers\ShopifyCategoryController;
use Modules\ShopifySync\Http\Controllers\ShopifyCouponController;
use Modules\ShopifySync\Http\Controllers\ShopifyCustomerController;
use Modules\ShopifySync\Http\Controllers\ShopifyOrderController;
use Modules\ShopifySync\Http\Controllers\ShopifyProductController;
use Modules\ShopifySync\Http\Controllers\ShopifySyncController;

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

Route::group(['middleware' => 'PlanModuleCheck:ShopifySync'], function ()
{
    Route::post('shopify/setting', [ShopifySyncController::class,'setting'])->name('shopify.setting')->middleware(['auth']);
    Route::resource('shopify-customer',ShopifyCustomerController::class)->middleware(['auth']);
    Route::resource('shopify-product',ShopifyProductController::class)->middleware(['auth']);
    Route::resource('shopify-order',ShopifyOrderController::class)->middleware(['auth']);
    Route::resource('shopify-category',ShopifyCategoryController::class)->middleware(['auth']);
    Route::resource('shopify-coupon',ShopifyCouponController::class)->middleware(['auth']);
});
