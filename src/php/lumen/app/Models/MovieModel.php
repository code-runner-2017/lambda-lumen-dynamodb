<?php

namespace App\Models;


use BaoPham\DynamoDb\DynamoDbModel;

class MovieModel extends DynamoDbModel
{

    // Set this to be able to mass assign attributes, eg. ->all() method
    protected $fillable = ['title', 'year'];

    protected $table = 'movies';
}