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

$router->group(['prefix' => 'checklists'], function () use ($router) {
    $router->get('/', 'CheckListController@all');
    $router->patch('complete', 'ItemController@complete');
    $router->patch('incomplete', 'IncompleteController@incomplete');
    $router->get('/{item}/items', 'CheckListController@items');
    $router->post('/{checklist}/items', 'ItemController@store');
    $router->get('/{checklist}/items/{item}', 'CheckListController@item');
});
