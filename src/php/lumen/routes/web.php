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

use Illuminate\Http\Request;
use App\Http\Controllers\MovieController;


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('movies',  ['uses' => 'MovieController@getAll']);

    $router->get('movies/{id}', ['uses' => 'MovieController@getById']);

    $router->post('movies', ['uses' => 'MovieController@create']);

    $router->delete('movies/{id}', ['uses' => 'MovieController@delete']);

    $router->put('movies/{id}', ['uses' => 'MovieController@update']);
});

$router->get('/hello', function () use ($router) {
    return 'hello world!';
});

