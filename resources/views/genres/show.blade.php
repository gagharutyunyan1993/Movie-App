@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card">
    <div class="card-header bg-dark text-light">
    <h5 style= "font-family: 'Anton', sans-serif;"> <strong>{{$genre->name}}</strong> </h5>

    </div>
    <div class="cantainer">
      <div class="row">
          <div class="card" style="width: 18rem;">
              <ul class="list-group list-group-flush">
                  @foreach($genre->movies as $movie)
                      <li class="list-group-item">
                          <a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->title}}</a>
                      </li>
                  @endforeach
              </ul>
          </div>
      </div>
    </div>
    <div class="text-center">
    @if(!Auth::guest())
      <a class="btn btn-success ribbon" style="color:white; width:200px;" href="{{route('genres.edit', ['genre' => $genre->id])}}" role="button" aria-pressed="true">Edit Genre</a><br><br>
      @endif
      <a class="btn btn-success ribbon" style="color:white; width:200px;" href="{{route('genres.index')}}" role="Button" style="float:left">Back</a>
  <br/><br/></div>
</div>

</div>
@endsection
