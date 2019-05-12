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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
|--------------------------------------------------------------------------
| API Routes for Users
|--------------------------------------------------------------------------
| Using Laravel Passport
| OAuth2
| http://your-domain.com/api/user/{route}
*/

Route::prefix('users')->group(function () {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('details', 'API\UserController@details');
    });
});
/*
|--------------------------------------------------------------------------
| API Routes for Articles
|--------------------------------------------------------------------------
*/
Route::prefix('article')->group(function () {
    Route::get('list', 'API\ArticlesController@list')->name('articles.list');
    Route::group(['middleware' => 'auth:api'], function () {
        //Auth
    });
});
