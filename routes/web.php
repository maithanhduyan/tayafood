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

// SHOP
Route::get('/', 'Shop\ProductController@show');

// Route::get('/user', function () {
//     return new UserResource(User::find(1));
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
