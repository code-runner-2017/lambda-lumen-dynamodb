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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('movies',  ['uses' => 'MovieController@showAll']);

    $router->get('movies/{id}', ['uses' => 'MovieController@showOne']);

    $router->post('movies', ['uses' => 'MovieController@create']);

    $router->delete('movies/{id}', ['uses' => 'MovieController@delete']);

    $router->put('movies/{id}', ['uses' => 'MovieController@update']);
});


$router->get('/hello', function () use ($router) {
    return 'hello world!';
});

$router->get('/test', function (Request $request) use ($router) {
    $obj = new \stdClass();
    $obj->title = 'Blade Runner';
    $obj->director = 'Riddley Scott';
    $obj->uri = $request->path();
    $obj->name = $request->input('name');
        
    return response()->json($obj);
});

/**
 * Example: Querying an RDS database (postgresql) using plain PDO.
 */
$router->get('/testdb', function (Request $request) use ($router) {
    $users = app('db')->select("SELECT * FROM users");    
    return response()->json($users);    
});

