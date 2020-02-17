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

Route::post('changeStatus', 'Admin\UserController@changeUserStatus');
Route::resource("users", "Admin\UserController");

Route::post('changePostStatus', 'Admin\PostController@changePostStatus');
Route::resource("posts", "Admin\PostController");

Route::resource("categories", "Admin\CategoryController");