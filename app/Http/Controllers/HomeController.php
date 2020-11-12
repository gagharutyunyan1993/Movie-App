<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Parser\Imdb;
use function GuzzleHttp\Psr7\str;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $users = User::get();
        $movie = Movie::paginate(16);


        return view('home', ['users' => $users, 'movies' => $movie]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user->id);

        return view('home', ['user' => $user]);
    }
}
