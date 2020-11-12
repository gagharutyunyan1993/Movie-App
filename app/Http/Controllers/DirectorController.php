<?php

namespace App\Http\Controllers;

use App\Models\Director;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::get();
        return view('directors/index', ['directors' => $directors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('directors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $director_name = $request->input('name');

        $director = new Director();
        $director->name = $director_name;

        $director->save();

        return redirect()->route('directors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Director $director
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Director $director)
    {
        return view('directors/show', ['director' => $director]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Director $director
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Director $director)
    {
        return view('directors/edit', ['director' => $director]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Director $director
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Director $director)
    {
        $director_name = $request->input('name');

        $director->name = $director_name;
        $director->save();

        return redirect()->route('directors.show', ['director' => $director->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Director $director
     */
    public function destroy(Director $director)
    {
        //
    }
}
