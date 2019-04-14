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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get(
    '/get-demo',
    function () {
        echo 343;
    }
);

Route::post(
    '/post-form-urlencode',
    function () {
        echo 343;
    }
);

Route::post(
    '/post-form-data',
    function () {
        echo 343;
    }
);

Route::post(
    '/post-json',
    function () {
        echo 343;
    }
);


Route::get(
    '/user/login',
    'JwtLoginController@login'
);


Route::middleware(['jwt_auth'])->group(
    function () {
        Route::get('/user/info', 'UserController@info');
    }
);

//Route::get('/user/info','UserController@info');



















