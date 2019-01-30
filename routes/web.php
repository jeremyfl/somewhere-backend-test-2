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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth', 'prefix' => 'checklists'], function () use ($router) {
// $router->group(['prefix' => 'checklists'], function () use ($router) {
    $router->get('/', 'CheckListController@all');
    $router->get('/{checklist}', 'CheckListController@show');
    $router->post('/', 'ItemController@store');
    $router->patch('/', 'ItemController@update');

    $router->patch('complete', 'ItemController@complete');
    $router->patch('incomplete', 'IncompleteController@incomplete');

    $router->get('/{item}/items', 'CheckListController@items');

    $router->post('/{checklist}/items', 'ItemController@store');
    $router->get('/{checklist}/items/{item}', 'CheckListController@item');
    $router->delete('/{checklist}/items/{item}', 'ItemController@delete');

    $router->post('/templates', 'TemplateController@store');
    $router->get('/templates/{template}', 'TemplateController@show');
    $router->patch('/templates/{template}', 'TemplateController@update');
    $router->delete('/templates/{template}', 'TemplateController@delete');
    $router->post('/templates/{template}/assign', 'TemplateController@assign');
});

$router->post('/login', 'AuthController@authenticate');
$router->post('/register', 'AuthController@store');
