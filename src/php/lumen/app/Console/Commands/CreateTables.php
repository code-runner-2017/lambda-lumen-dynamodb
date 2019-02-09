<?php
namespace App\Console\Commands;


use Illuminate\Console\Command;

class CreateTables extends Command
{
    protected $signature = 'dynamodb:create-tables';

    protected $description = 'DynamoDB Create Tables';

    public function handle()
    {
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

        $schema = (require __DIR__ . '/../../../database/dynamodb/tables.php');

        foreach ($schema as $tableSchema) {
            try {
                $dynamodb->deleteTable($tableSchema);
            } catch (Exception $ex) {
                // safely ignore
            }

            $table = $dynamodb->createTable($tableSchema);
        }
        
        echo "Create tables";
    }
}