<?php

use App\Http\Controllers\HomeController;
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

Route::group(['namespace' => 'Post'], function () {
    Route::get('/', 'IndexController')->name("post.index");
    Route::get('/post/{post}', 'ShowController')->name("post.show");
    Route::get('/all', 'AllController')->name("post.all");
    Route::get('/categories', 'CategoriesController')->name("post.categories");
    Route::get('/authors', 'AuthorsController')->name("post.authors");
});


Route::group(['namespace' => 'Profile', 'middleware' => 'profile'], function () {
    Route::get('/profile', 'IndexController')->name("profile");
});


Route::group(['namespace' => 'Admin'], function () {
    Route::get('/admin', 'IndexController')->name("admin");
});


//Route::group(['namespace' => 'Post'], function () {
//    Route::get('/blog', 'IndexController')->name("post.index");
//    Route::get('/blog/{post}', 'ShowController')->name("post.show");
//});


Route::group(['namespace' => 'Gallery'], function () {
    Route::get('/gallery', 'IndexController')->name("gallery.index");
});


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
