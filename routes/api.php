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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->post('/login/', 'App\Http\Controllers\Api\V1\UserController@login');

    $api->group([
        'namespace' => 'App\Http\Controllers\Api\V1',
        'middleware' => ['api.auth', 'jwt.refresh']
    ], function ($api) {
        $api->get('/users/items/', 'UserController@items');
    });
});
