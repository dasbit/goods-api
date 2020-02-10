<?php

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

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->post('/auth/login', 'Auth\AuthController@login');
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/categories/tree', 'CategoriesController@tree');
    $router->get('/categories', 'CategoriesController@index');
    $router->post('/categories' , 'CategoriesController@store');
    $router->put('/categories/{id}', 'CategoriesController@update');
    $router->delete('/categories/{id}', 'CategoriesController@destroy');
});
