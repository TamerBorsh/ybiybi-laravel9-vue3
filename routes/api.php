<?php

use App\Http\Controllers\Api\Auth\LoginController;
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
        Route::get('login',         'index')->name('auth.login');
        Route::post('login',        'authenticate')->name('auth.authenticate');
        Route::get('logout',        'logout')->name('auth.logout');
    });
    
    });