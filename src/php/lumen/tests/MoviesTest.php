<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MoviesTest extends TestCase
{
    public static function setUpBeforeClass()
    {

        $this->get('/createtables');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $x = $this->json('POST', '/api/movies', ['title' => 'Sally']);

        echo $x;
    }
}
