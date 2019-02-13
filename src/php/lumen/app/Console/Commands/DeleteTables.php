<?php
namespace App\Console\Commands;


use BaoPham\DynamoDb\DynamoDbClientService;
use Illuminate\Console\Command;

class DeleteTables extends Command
{
    protected $signature = 'dynamodb:delete-tables';

    protected $description = 'DynamoDB Delete Tables';

    public function handle(DynamoDbClientService $dynamoService)
    {
        $dynamodb = $dynamoService->getClient();

        $schema = (require __DIR__ . '/../../../database/dynamodb/tables.php');

        foreach ($schema as $tableSchema) {
            try {
                $dynamodb->deleteTable($tableSchema);
            } catch (\Exception $ex) {
                // safely ignore
            }
        }
        
        echo "Deleted tables";
    }
}