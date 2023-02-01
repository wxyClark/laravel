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

    //  AbcDemo 代码模板
    Route::group(['namespace' => 'AbcDemo', 'prefix' => 'demo'], function () {
        //  BusinessName 业务名称
        Route::get('/BusinessName/index', 'BusinessNameController@index');
        Route::get('/BusinessName/detail', 'BusinessNameController@detail');
        Route::get('/BusinessName/export', 'BusinessNameController@export');
        Route::get('/BusinessName/log', 'BusinessNameController@log');
        Route::post('/BusinessName/add', 'BusinessNameController@add');
        Route::post('/BusinessName/batchUpdate', 'BusinessNameController@batchUpdate');
        Route::post('/BusinessName/changeStatus', 'BusinessNameController@changeStatus');
        Route::post('/BusinessName/update', 'BusinessNameController@update');

        //  RuleName 规则名称
        Route::get('/RuleName/index', 'RuleNameController@index');
        Route::get('/RuleName/detail', 'RuleNameController@detail');
        Route::get('/RuleName/export', 'RuleNameController@export');
        Route::get('/RuleName/log', 'RuleNameController@log');
        Route::post('/RuleName/add', 'RuleNameController@add');
        Route::post('/RuleName/batchUpdate', 'RuleNameController@batchUpdate');
        Route::post('/RuleName/changeStatus', 'RuleNameController@changeStatus');
        Route::post('/RuleName/update', 'RuleNameController@update');
        Route::post('/RuleName/match', 'RuleNameController@match');
    });

});
