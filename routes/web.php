<?php

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
| 前段直接调用
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'v1'], function () {
    //  运维检测
    Route::group(['namespace' => 'DevOps'], function () {
        Route::get('/health/web', function () {
            $response = [
                'code' => '200',
                'data' => ['health' => true],
                'msg' => 'web is health',
            ];
            return response()->json($response);
        });
        Route::get('/health/db', function () {return response()->json([1]);});
        Route::get('/health/redis', function () {return response()->json([1]);});
        Route::get('/health/memcached', function () {return response()->json([1]);});
    });

});
