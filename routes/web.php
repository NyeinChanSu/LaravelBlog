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

Route::get('/','PostsController@index')->name('home');

Route::get('/news','PostsController@news');

Route::get('/authors','PostsController@authors');

Route::get('/tags','PostsController@tags');

Route::get('posts/{post}','PostsController@show');

Route::get('/post/create','PostsController@create');

Route::post('/create','PostsController@store');

// Route::post('/posts/{post}/comments','CommentsController@store');

Route::get('/post/showall','PostsController@showall');



Route::get('/type/create','TypesController@create');

Route::post('/typeCreate','TypesController@store');

Route::get('/type/showall','TypesController@showall');

//For Edit and Delete Types
Route::post('/typeEdit','TypesController@edit');

Route::post('/typeDelete','TypesController@delete');


Route::get('/tag/index','TagsController@index');

Route::post('/tagCreate','TagsController@store');

Route::get('/tag/showall','TagsController@showall');

//For Edit and Delete Tags
Route::post('/tagEdit','TagsController@edit');

Route::post('/tagDelete','TagsController@delete');


//For Edit and Delete Posts
Route::get('/post/edit/{post}','PostsController@edit');

Route::post('/update','PostsController@update');

// Route::post('/post/{id?}/delete','PostsController@destroy');

Route::post('/delete','PostsController@destroy');


//For Edit and Delete Comments
Route::get('/comment/showall','CommentsController@showall');

Route::get('/comment/edit/{comment}','CommentsController@edit');

Route::post('/comupdate','CommentsController@update');

Route::post('/commentDelete','CommentsController@delete');

Route::group(['middleware' => 'auth'], function()
{
	Route::match(['post'], '/posts/{post}/comments', 'CommentsController@store');
});

Route::group(['middleware' => 'memberauth'], function()
{
	Route::match(['post'], '/posts/{post}/comments', 'CommentsController@memberStore');
});



//For Edit and Delete Users
Route::get('/user/create','UsersController@create');

Route::post('/userCreate','UsersController@store');

Route::get('/user/showall','UsersController@showall');

Route::get('/user/edit/{user}','UsersController@edit');

Route::post('/userUpdate','UsersController@update');

Route::post('/userDelete','UsersController@delete');


//For Members
Route::get('/member/create','MembersController@showRegister');

Route::post('/memberRegister','MembersController@register');

Route::get('/member/login','MembersController@showlogin');

Route::post('/memberLogin','MembersController@login');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout','SessionController@destroy');

Route::get('/homeLogout','SessionController@homeLogout');

Route::get('/memberlogout','SessionController@memberLogout');

//Backend Admin Dashboard

Route::get('/search','SearchController@search');


Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
	Route::match(['get', 'post'], '/dashboard/', 'AdminController@admin');
});

Route::group(['middleware' => 'App\Http\Middleware\Editor'], function()
{
	Route::match(['get', 'post'], '/dashboard/', 'AdminController@editor');
});


