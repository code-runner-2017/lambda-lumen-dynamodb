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

// TODO: right now works on local dynamo only
// see https://github.com/baopham/laravel-dynamodb/issues/90
$router->get('/createtables', function (Request $request) use ($router) {
    $sdk = new \Aws\Sdk([
            'endpoint' => 'http://localhost:8000',
            'region' => 'eu-central-1',
            'version' => 'latest',
            'credentials' => [
                'key'    => 'dynamodb_local',
                'secret' => 'secret',
            ],
	]);

	$dynamodb = $sdk->createDynamoDb();

    $schema = (require __DIR__ . '/../database/dynamodb/tables.php');

    foreach ($schema as $tableSchema) {
        try {
            $dynamodb->deleteTable($tableSchema);
        } catch (Exception $ex) {
            // safely ignore
        }

        $table = $dynamodb->createTable($tableSchema);
    }

    return "OK";
});
