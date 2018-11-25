<?php

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

use App\Http\Controllers\Api\Admin\User;
use App\Http\Controllers\Api\Auth\Activate;
use App\Http\Controllers\Api\Auth\Confirm;
use App\Http\Controllers\Api\Auth\Login;
use App\Http\Controllers\Api\Auth\Logout;
use App\Http\Controllers\Api\Auth\Me;
use App\Http\Controllers\Api\Auth\Refresh;
use App\Http\Controllers\Api\Auth\Register;
use App\Http\Controllers\Api\Auth\Remember;
use App\Http\Controllers\Api\Auth\Reset;
use App\Http\Response\Answer;
use App\Http\Routing\Router;

Router::prefix('v1')->group(function () {
    /** open routes */

    Router::post('/auth/register', Register::class);
    Router::post('/auth/confirm', Confirm::class);
    Router::post('/auth/login', Login::class);
    Router::post('/auth/logout', Logout::class);
    Router::post('/auth/refresh', Refresh::class);
    Router::post('/auth/remember', Remember::class);
    Router::get('/auth/activate/{code}', Activate::class);
    Router::get('/auth/reset/{code}', Reset::class);

    Router::restricted()->group(function () {
        /** restricted routes */
        Router::get('/auth/me', Me::class);

        Router::api('/admin/user', User::class);
    });
});

if (env('APP_DEBUG')) {
    Router::get('/info', function () {
        echo phpinfo();
    });
}

Router::match(['GET', 'POST', 'DELETE'], '{any}', function () {
    return Answer::error('Route not found', 404);
})->where('any', '.*');
