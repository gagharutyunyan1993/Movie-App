<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchMovie(Request $request)
    {
        $data = Movie::select("title as label",'id')
            ->where("title","LIKE","%{$request->term}%")
            ->orderBy('title','asc')
            ->limit(15)
            ->get();

        return response()->json($data);
    }

    public function searchActor(Request $request){
        $data = Actor::select("name as label",'id')
            ->where("name","LIKE","%{$request->term}%")
            ->orderBy('name','asc')
            ->limit(15)
            ->get();

        return response()->json($data);
    }
}
