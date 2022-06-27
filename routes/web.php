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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('/users',['uses' => 'UserController@getUsers']);
});

$router->get('/users','UserController@index'); //shows all data
$router->post('/users','UserController@add'); //adds data
$router->get('/users/{userId}','UserController@show'); //shows specific data
$router->put('/users/{userId}','UserController@update'); //updates data
$router->delete('/users/{userId}','UserController@delete'); //deletes data


$router->get('/usersjob','UserJobController@index'); //shows all user job
$router->get('/usersjob/{jobId}','UserJobController@show'); //shows a specific user job
