@extends('layouts/app')
@section('content')

    <div class="p-3 mb-2 text-white" style="background-color:#33001a">
        <h3>Add New Movies</h3>
    </div>

    <br/>
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('error')}}
        </div>

    @endif

    <form method="post" action="{{route('movies.store')}}">
        @csrf

        <div class="container" style="color:white;">

            <p style="color: #1b1e21"><b>Add Picture link</b></p>
            <div class="form-group">
                <input type="url" name="picture" class="form-control" value="" placeholder="Picture link">
            </div>

            <div>
                <p style="color: #1b1e21"><b>Text Movie name</b></p>
                <input type="text" name="title" class="form-control" value="" placeholder="Movie title">
            </div>
            <br/>
            <div>
                <p style="color: #1b1e21"><b>Release Date</b></p>
                <input type="date" name="releaseDate" class="form-control" value="" placeholder="Relese Date">
            </div>
            <br/>
            <div>
                <p style="color: #1b1e21"><b>RunTime</b></p>
                <input type="time" name="runtime" class="form-control" value="z" placeholder="Runtime">
            </div>
            <br/>
            <div>
                <p style="color: #1b1e21"><b>Description</b></p>
                <textarea rows="10" cols="50" class="form-control" name="description"
                          placeholder="Description"></textarea>
            </div>
            <br/>
            <!-- Director  -->
            <div class="form-group">

                <!--  Director  -->
                <div>
                    <p style="color: #1b1e21"><b>Choose Director</b></p>
                    <br/>
                    <select name="directors[]" multiple="multiple">
                        <option value="">-</option>
                        @foreach($directors as $director)
                            <option value="{{ $director->id }}">{{ $director->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Actors -->
                <div>
                    <p style="color: #1b1e21"><b>Choose Actors</b></p>
                    <br/>
                    <select name="actors[]" multiple="multiple">
                        <option value="">-</option>
                        @foreach($actors as $actor)
                            <option value="{{ $actor->id }}">{{$actor->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Genres  -->
                <div>
                    <p style="color: #1b1e21"><b>Choose Genres</b></p>
                    <br/>
                    <select name="genres[]" multiple="multiple">
                        <option value="">-</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{$genre->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br/>
                <div>
                    <input type="submit" class="btn-danger" value="Update">
                </div>
                <br/>
                <br/>
            </div>
    </form>
@endsection
