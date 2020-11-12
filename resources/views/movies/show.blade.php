@extends('layouts/app')
@section('content')
<?php

?>
    <div class="p-3 mb-2 bg-dark text-white">
        <div class="card-header">
            <div class="col-8">
                <h5><strong>{{$movie->title}}</strong></h5>
            </div>
        </div>
        @if(Auth::check())
            <div class="col-4">
                <a class="btn btn-success ribbon" style="color:white;"
                   href="{{route('movies.edit', ['movie'=> $movie['id']])}}" role="button" aria-pressed="true">Edit
                    Movie</a>
                <a class="btn btn-success ribbon" style="color:white;" href="{{route('movies.index')}} " role="button"
                   aria-pressed="true">Movie List</a>
            </div>
        @endif
    </div>


    <div class="container">
        <div class="card">
            <br/>
            <div class="col-9">
                <div class="card">
                    <ul class="list-group-item ">
                        <li class="list-group-item">
                            <img src="{{$movie->picture}}" class="card-img-top" alt="...">

                        <li class="list-group-item">
                            <strong>Description: </strong>{{$movie->description}}</li>
                        <li class="list-group-item">
                            <strong>Run Times: </strong>{{$movie->runtime}} </li>
                        <li class="list-group-item">
                            <strong>Director:</strong>
                            @foreach($movie->directors as $director)
                                <a href="{{route('directors.show', ['director' => $director->id])}}">{{$director->name}}</a>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>Genre:</strong>
                            @foreach($movie->genres as $genre)
                                <a href="{{route('genres.show', ['genre' => $genre->id])}}" class="">{{$genre->name}} , </a>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>Actor:</strong>
                            @foreach($movie->actors as $actor)
                                <a href="{{route('actors.show', ['actor' => $actor->id])}}">" {{$actor->name}} ",</a>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <br/>
            </div>
        </div>
    </div>
@endsection
