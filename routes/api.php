<?php

use Illuminate\Http\Request;
use App\Post;

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


Route::get('posts','Api\PostsController@index');

Route::get('posts/{post}','Api\PostsController@show');

Route::post('posts','Api\PostsController@store');

Route::put('posts/{post}','Api\PostsController@update');

Route::delete('posts/{post}','Api\PostsController@delete');



