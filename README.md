# Run AWS Lambda with Lumen

The full story here: https://link.medium.com/4bRFZ3kJqT 

# Changes to run (lumen-dynamodb)[https://github.com/digiaonline/lumen-dynamodb] 

These are needed if you want to replicate this in your alredy existing application:

- in app.php:
    $app->configure('services');

    $app->register(Nord\Lumen\DynamoDb\DynamoDBServiceProvider::class);


# Instructions to run locally

- Copy .env.example to .env 

- Unzip and run DynamoDB locally as explained (here)[http://docs.aws.amazon.com/amazondynamodb/latest/developerguide/Tools.DynamoDBLocal.html].

- Edit the `database/dynamodb/tables.php` and run this to create the tables:

    php artisan dynamodb:create --config=database/dynamodb/tables.php


    