@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5><strong>{{$movie->title}}</strong></h5>
                            <p>{{$movie->releaseDate}}</p>
                            <p>{{$movie->runtime}} hr</p>
                        </div>
                        <div class="card-body">
                            <img  class="img-fluid" alt="Responsive image" width="200" height="250" src="{{$movie->picture}}"><br/>
                            <a href="{{route('movies.show', ['movie'=>$movie->id])}}" class="btn btn-success">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="d-flex justify-content-center">
                    {!! $movies->links("vendor.pagination.bootstrap-4") !!}
                </div>
        </div>
    </div>
@endsection
