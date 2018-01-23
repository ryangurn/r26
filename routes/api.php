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

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'user'], function(Router $api) {
        $api->get('/all', 'App\\Http\\Controllers\\Api\\UserController@all');
        $api->get('/count', 'App\\Http\\Controllers\\Api\\UserController@count');

        //$api->get('/{id}/disable', 'App\\Http\\Controllers\\Api\\UserController@disable');
        $api->post('/', 'App\\Http\\Controllers\\Api\\UserController@create');
        $api->get('/{id}', 'App\\Http\\Controllers\\Api\\UserController@read');
        $api->post('/{id}', 'App\\Http\\Controllers\\Api\\UserController@update');
        $api->get('/delete/{id}', 'App\\Http\\Controllers\\Api\\UserController@delete');


    });

    $api->group(['prefix' => 'availability'], function(Router $api){
        $api->post('/', 'App\\Http\\Controllers\\Api\\UserController@availabilityCreate');
        $api->get('/{id}', 'App\\Http\\Controllers\\Api\\UserController@availabilityRead');
        $api->post('/{id}', 'App\\Http\\Controllers\\Api\\UserController@availabilityUpdate');
        $api->get('/delete/{id}', 'App\\Http\\Controllers\\Api\\UserController@availabilityDelete');
    });
});