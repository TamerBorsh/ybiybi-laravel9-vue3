<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {

    Route::controller(LoginController::class)->prefix('auth')->group(function () {
        Route::post('login',        'authenticate');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('products',        'index');
        Route::post('products/upload',        'UploadByDubbed');

    });

    // Route::resources([
    //     'products'              => ProductController::class,
    //  ]);

     
});
