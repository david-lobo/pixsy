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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'PostController@index')->name('home');
Route::get('/test', 'PostController@test')->name('test');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController', ['only' => ['index', 'create', 'store']]);

Route::post('posts/media', 'PostController@storeMedia')
  ->name('posts.storeMedia');

Route::get('ajax/posts', 'Ajax\PostController@index')->name('posts.get');
