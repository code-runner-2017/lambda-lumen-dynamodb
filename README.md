# Run AWS Lambda with Lumen

The full story here: https://link.medium.com/4bRFZ3kJqT 

# Changes to run (lumen-dynamodb) 

These are needed if you want to replicate this in your alredy existing application:

- changes to bootstrap/app.php:
```
    $app->configure('services');
    ...
    $app->register(Nord\Lumen\DynamoDb\DynamoDBServiceProvider::class);
```    

See [lumen-dynamodb](https://github.com/digiaonline/lumen-dynamodb) for further details.

# Instructions to run locally

- Copy .env.example to .env 

- Unzip and run DynamoDB locally as explained (here)[http://docs.aws.amazon.com/amazondynamodb/latest/developerguide/Tools.DynamoDBLocal.html].
```
    java -Djava.library.path=./DynamoDBLocal_lib -jar DynamoDBLocal.jar -sharedDb
```    
With powershell:
```
    java -D"java.library.path=./DynamoDBLocal_lib" -jar DynamoDBLocal.jar
```

- open a shell under `src/php/lumen`

- run:
```
    composer update
```

- Edit the `database/dynamodb/tables.php` and run this to create the tables:
```
    php artisan dynamodb:create-tables
```
  
In you change something, delete the table and create them again:
```
    php -S localhost:8001 -t public
```
# API Usage


    $ curl -X POST -H 'Content-Type:application/json' http://localhost:8001/api/movies -d '{"title":"Blade Runner"}'

    $ curl  http://localhost:8001/api/movies | jq .
    
    $ curl  http://localhost:8001/api/movies/<YOURID> | jq .
    
    $ curl  -X DELETE http://localhost:8001/api/movies/<YOURID>
           
    $ curl  -X DELETE http://localhost:8001/api/movies/*
 
    $ curl -X PUT -H 'Content-Type:application/json' http://localhost:8001/api/movies/8c9a52d8-bd19-4881-a436-2d6eddfd8a8e -d '{"title":"Blade Runner 2049"}'