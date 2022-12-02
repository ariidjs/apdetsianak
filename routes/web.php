<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/grow/{nik}','AnakController@insertGrowAnak');
    $router->get('/grow/{nik}','AnakController@getHistory');
    $router->post('/login', 'AnakController@login');
    $router->post('/identitasanak/{no_kk}', 'AnakController@insertIdentitasAnak');
    $router->get('/identitasanak/{no_kk}', 'AnakController@getAnaks');
    $router->post('/signUp', 'AnakController@insert');
});


$router->get('/', function () use ($router) {
    return $router->app->version();
});
