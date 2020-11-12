<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::paginate(16);

        return view('movies/index', ['movies' => $movie]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = Movie::orderBy('title')->get();
        $directors = Director::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $actors = Actor::orderBy('name')->get();
        return view('movies.create', [
            'movies' => $movie,
            'directors' => $directors,
            'genres' => $genres,
            'actors' => $actors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Movie::whereTitle($request['title'])->exists()) {
            return redirect()->back()->with('error', 'Film Already Exists');
        }

        $movie = Movie::create([
            'title' => $request['title'],
            'picture' => $request['picture'],
            'description' => $request['description'],
            'runtime' => $request['runtime'],
            'releaseDate' => $request['releaseDate']
        ]);

        $movie->directors()->sync($request->input('directors'));
        $movie->actors()->sync($request->input('actors'));
        $movie->genres()->sync($request->input('genres'));

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Movie $movie)
    {
        $movie->load(['actors', 'directors']);
        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'movie' => $movie,
            'directors' => Director::orderBy('name')->get(),
            'genres' => Genre::orderBy('name')->get(),
            'actors' => Actor::orderBy('name')->get(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Movie $movie)
    {
        $this->validate($request,
            [
                'picture' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'releaseDate' => 'required|string|max:255',
                'runtime' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);

        $movie->update([
            'title' => $request['title'],
            'picture' => $request['picture'],
            'description' => $request['description'],
            'runtime' => $request['runtime'],
            'releaseDate' => $request['releaseDate']
        ]);

        $movie->save();
        $movie->directors()->sync($request->input('directors'));
        $movie->actors()->sync($request->input('actors'));
        $movie->genres()->sync($request->input('genres'));

        return redirect()->route('movies.show', ['movie' => $movie->id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
