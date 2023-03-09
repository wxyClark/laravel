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

Route::group(['prefix' => 'v2'], function () {
    //  用户权限
    Route::group(['namespace' => 'rbac'], function () {
        //  用户管理
        Route::post('user/create', 'UserController@create');    //  创建
        Route::put('user/update', 'UserController@update');     //  编辑
        Route::put('user/changeStatus', 'UserController@changeStatus');     //  修改状态
        Route::delete('user/delete', 'UserController@delete');  //  逻辑删除
        Route::get('user/detail', 'UserController@detail');     //  详情
        Route::post('user/index', 'UserController@index');      //  列表。使用POST兼容参数过程的情况
        Route::post('user/export', 'UserController@export');    //  导出。使用POST兼容参数过程的情况

        //  角色管理
        Route::post('role/create', 'RoleController@create');    //  创建
        Route::put('role/update', 'RoleController@update');     //  编辑
        Route::delete('role/delete', 'RoleController@delete');  //  逻辑删除
        Route::get('role/detail', 'RoleController@detail');     //  详情
        Route::post('role/index', 'RoleController@index');      //  列表
        Route::post('role/export', 'RoleController@export');    //  导出

        //  权限管理
        Route::post('authority/create', 'AuthorityController@create');    //  创建
        Route::put('authority/update', 'AuthorityController@update');     //  编辑
        Route::delete('authority/delete', 'AuthorityController@delete');  //  逻辑删除
        Route::get('authority/detail', 'AuthorityController@detail');     //  详情
        Route::post('authority/index', 'AuthorityController@index');      //  列表
        Route::post('authority/export', 'AuthorityController@export');    //  导出

        //  授权管理
        Route::post('authorize/create', 'AuthorizeController@create');    //  创建
        Route::put('authorize/update', 'AuthorizeController@update');     //  编辑
        Route::delete('authorize/delete', 'AuthorizeController@delete');  //  逻辑删除
        Route::get('authorize/detail', 'AuthorizeController@detail');     //  详情
        Route::post('authorize/index', 'AuthorizeController@index');      //  列表
        Route::post('authorize/export', 'AuthorizeController@export');    //  导出
    });

    //  单点登录
    Route::group(['namespace' => 'sso'], function () {
        //  登录操作
        Route::post('sso/login', 'SsoController@login');        //  登录
        Route::post('sso/logout', 'SsoController@logout');      //  退出
        Route::post('sso/reset', 'SsoController@reset');        //  修改密码
        Route::post('ssoLog/index', 'SsoLogController@index');  //  登录日志
    });

    //  操作日志
    Route::group(['namespace' => 'operate'], function () {
        //  登录操作
        Route::post('operateLog/create', 'OperateLogController@create');    //  创建
        Route::post('operateLog/index', 'OperateLogController@index');      //  列表
        Route::post('operateLog/export', 'OperateLogController@export');    //  导出
    });
});

//  运维、demo、灰度
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
        Route::get('/BusinessName/demo', 'BusinessNameController@demo');
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
