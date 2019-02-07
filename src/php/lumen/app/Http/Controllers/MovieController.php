<?php

namespace App\Http\Controllers;

use App\Models\MovieModel;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showAll()
    {

    }

    public function showOne()
    {
        return (object) [
            '1111'
        ];
    }

    public function create()
    {
        $movie = new MovieModel();
        $movie->setTitle('Blade Runner');
        $movie->save();

        return $movie->toJson();
    }

    public function update()
    {
        return (object) [
            '1111'
        ];
    }

    public function delete()
    {

    }
}
