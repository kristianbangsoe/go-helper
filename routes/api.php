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

Route::get('opgaver', 'PostsController@IndexApi');

Route::get('opgaver/{id}', 'PostsController@showApi');

Route::post('opgave', 'PostsController@store');

Route::put('opgaver', 'PostsController@store');

Route::delete('opgaver', 'PostsController@destroy');

Route::get('users', 'UserController@UserIndexApi');

Route::get('categories', 'CategoryController@CategoryIndexApi');