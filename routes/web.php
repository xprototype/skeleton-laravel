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

use App\Http\Controllers\File\Download;
use App\Http\Controllers\File\Upload;
use App\Http\Routing\Router;

Router::get('/', function () {
    return view('welcome');
});

Router::restricted()->group(function () {
    /** restricted routes */
    Router::get('/statics/{any}', Download::class)->where('any', '.*');
    Router::post('/statics/{any}', Upload::class)->where('any', '.*');
});
