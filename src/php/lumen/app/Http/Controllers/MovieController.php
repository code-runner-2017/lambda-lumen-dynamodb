<?php

namespace App\Http\Controllers;

use App\Models\MovieModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * curl  http://localhost:8001/api/movies
     * curl  http://localhost:8001/api/movies?title=argo
     *
     * @param MovieModel $model
     * @param Request $request
     * @return MovieModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll(MovieModel $model, Request $request)
    {
        $title = $request->input('title');

        if ($title == null) {
            return $model->all();
        } else {
            return $model->where('title', '=', $title)->get();
        }
    }

    public function getById(MovieModel $model, string $id)
    {
        return $model->find($id);
    }

    public function create(Request $request)
    {
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');

        if ($title === null) {
            return response()->json([
                'error' => 'Bad Request',
                'message' => "Missing mandatory 'title'"],
                400);
        }

        $movie = new MovieModel();
        $movie->id = Str::uuid()->toString();
        $movie->title = $title;
        $movie->year = $year;
        $movie->director = $director;
        $movie->save();

        return $movie->id;
    }

    public function update(MovieModel $model, Request $request, string $id)
    {
        $movie = $model->findOrFail($id);
        $title = $request->input('title');

        $movie->title = $title;
        $movie->save();

        return $movie->id;
    }

    public function delete(MovieModel $model, string $id)
    {
        if ($id == '*')
        {
            // empty the whole table, deleting each record
            $model->chunk(100, function ($movies) {
                foreach ($movies as $movie) {
                    $movie->delete();
                }
            });

        } else {
            $model->find($id)->delete();
        }
    }
}

?>
