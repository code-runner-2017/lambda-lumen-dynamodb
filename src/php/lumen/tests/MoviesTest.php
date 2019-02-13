<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MoviesTest extends TestCase
{
    /**
     * @test
     */
    public function create_read_delete()
    {
        $movies = json_decode(file_get_contents(__DIR__ .'/movies.json'));

        // insert all movies into Dynamodb
        foreach ($movies as $movie) {
            $this->_createMovie(['title' => $movie->title, 'year' => @$movie->year]);
            $this->assertResponseOk();
            $movie->id = $this->response->getContent();
        }

        // retrieve each movie and check data
        foreach ($movies as $movie) {
            $this->json('GET', '/api/movies/' . $movie->id)
                ->seeJson(['title' => $movie->title]);
            $this->assertResponseOk();
        }

        // delete all created movies
        foreach ($movies as $movie) {
            $this->_deleteMovie($movie->id);
            $this->assertResponseOk();
        }
    }

    /**
     * @test
     */
    public function search_by_title()
    {
        // create a movie with a unique title
        $title = 'unit-test-' . rand(0,10000);  // generate unique title
        $this->_createMovie(['title' => $title, 'year' => 2000]);
        $this->assertResponseOk();
        $id = $this->response->getContent();

        // search by title
        $this->json('GET', '/api/movies?title=' . $title)
            ->seeJson(['id' => $id]);

        // cleanup
        $this->_deleteMovie($id);
        $this->assertResponseOk();
    }

    private function _createMovie(array $values)
    {
        return $this->json('POST', '/api/movies',
            $values,
            ['api_token' => env('API_TOKEN')]);
    }

    private function _deleteMovie(string $id)
    {
        return $this->json('DELETE', '/api/movies/' . $id,
            [],
            ['api_token' => env('API_TOKEN')]);
    }
}
