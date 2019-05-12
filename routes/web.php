<?php
use App\User;
use App\Http\Resources\User as UserResource;

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

Auth::routes();

// SHOP
Route::get('/', 'Shop\ProductController@show');

/*
|--------------------------------------------------------------------------
| Home 
|--------------------------------------------------------------------------
*/
Route::get('/home', 'HomeController@index')->name('home');
/*
|--------------------------------------------------------------------------
| Articles 
|--------------------------------------------------------------------------
*/

Route::get('/article', 'ArticlesController@index')->name('article.index');
