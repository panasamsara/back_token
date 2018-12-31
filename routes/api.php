<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['api','cors']], function () {
    Route::post('register', 'ApiController@register');     // 注册
    Route::post('login', 'ApiController@login');           // 登陆
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('get_user_details', 'APIController@get_user_details');  // 获取用户详情
        Route::post('quitLogin', 'APIController@quitLogin');  // 退出登录
    }); 

    Route::post('articles', 'ArticleController@index'); //文章列表
    Route::post('create_article', 'ArticleController@store'); //新增文章
    Route::post('update_article/{id}', 'ArticleController@update'); //编辑文章
    Route::post('delete_article/{id}', 'ArticleController@destroy'); //删除文章

    Route::post('user_list', 'UserController@index');

    Route::post('role_list', 'RoleController@index'); //角色列表
    Route::post('role_add', 'RoleController@store'); //角色新增
    Route::post('role_update/{id}', 'RoleController@index'); //角色更新
    Route::post('role_delete/{id}', 'RoleController@destroy'); //角色更新

    Route::post('menu_list', 'MenuController@index');
});

