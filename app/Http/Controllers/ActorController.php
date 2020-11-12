<?php

namespace App\Http\Controllers;

use App\Models\Actor;

use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::get();
        return view('actors/index', ['actors' => $actors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actor_name = $request->input('name');

        $actor = new Actor();
        $actor->name = $actor_name;

        $actor->save();

        return redirect()->route('actors.index');

    }

    /**
     *  Display the specified resource.
     *
     * @param Actor $actor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Actor $actor)
    {
        return view('actors/show', ['actor' => $actor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Actor $actor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Actor $actor)
    {
        return view('actors/edit', ['actor' => $actor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Actor $actor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Actor $actor)
    {
        $actor_name = $request->input('name');
        $actor->name = $actor_name;
        $actor->save();


        return redirect()->route('actors.show', ['actor' => $actor->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Actor $actor
     */
    public function destroy(Actor $actor)
    {
        //
    }
}
