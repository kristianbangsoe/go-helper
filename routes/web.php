<?php

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

Route::group(['middleware' => ['auth']], function() {
    
Route::post('profile', 'UserController@update_avatar');

Route::get('profile', 'UserController@profile')->name('profile');

});



Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'My name is '.$id.$name;
});

Route::resource('users', 'UserController');

Route::resource('posts', 'PostsController');

Route::resource('category', 'CategoryController');

Route::resource('userCategories', 'UserCategoriesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
