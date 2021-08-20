<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('profiles/{user}', 'ProfileController@show')->name('profiles.show');
Route::get('profiles/{user}/edit', 'ProfileController@edit')->name('profiles.edit');
Route::patch('profiles/{user}', 'ProfileController@update')->name('profiles.update');

// Route::resource('profiles', 'ProfileController');

//PostController
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts', 'PostController@store')->name('posts.store');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');

// Route::resource('posts', 'PostController');

//followers
Route::post('/follows/{profile}', 'FollowController@store')->name('follows.store');