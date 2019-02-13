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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('movies',  ['uses' => 'MovieController@getAll']);
    $router->get('movies/{id}', ['uses' => 'MovieController@getById']);
    $router->post('movies', ['middleware' => 'auth', 'uses' => 'MovieController@create']);
    $router->delete('movies/{id}', ['middleware' => 'auth', 'uses' => 'MovieController@delete']);
    $router->put('movies/{id}', ['middleware' => 'auth', 'uses' => 'MovieController@update']);
});

$router->get('/hello', function () use ($router) {
    return 'hello world!';
});

// !!!! Security Warning!!!!
// You can uncomment this section for troubleshoothing.
// However, you must be aware of serious security risks, as it shows your secret key
// to whoever invokes the API. At least replace SECRET with a string that you know
// and comment again immediately.
/*
$router->get('/phpinfo-SECRET', function () use ($router) {
    phpinfo();
});
*/