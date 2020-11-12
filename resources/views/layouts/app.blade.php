<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Movie Database</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Test -->
    <style>
        .ui-menu-item-wrapper{
            cursor: pointer!important;
        }
        #ui-id-1 ,#ui-id-2 {
            background-color: white;
            max-height: 400px!important;
            overflow-y: scroll;
            color: black;

        }
    </style>

</head>
<body>
<div id="app">
    <div class="container ">
        <div class="container ">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-success">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Кинопоиск
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                            <li><a class="navbar-brand" href="{{route('movies.index')}}">Movies</a></li>
                            <li><a class="navbar-brand" href="{{route('directors.index')}}">Directors</a></li>
                            <li><a class="navbar-brand" href="{{route('actors.index')}}">Actors</a></li>
                            <li><a class="navbar-brand" href="{{ route ('genres.index') }}">Genres</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <nav>
                <div class="ui-widget">
                    <form>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="movies" class="form-control" placeholder="Search Movie">
                            </div>
                            <div class="col">
                                <input type="text" id="actors" class="form-control" placeholder="Search Actor">
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>

</body>
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function () {
        function log(message) {
            $("<div style='cursor: pointer'>").text(message).prependTo("#log");
            $("#log").scrollTop(0);
        }
        $("#movies").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{route('searchMovie')}}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                log("Selected: " + ui.item.title + " aka " + ui.item.id);
                window.location.href = '/movies/' + ui.item.id
            }
        });
    });
    $(function () {
        function log(message) {
            $("<div style='cursor: pointer'>").text(message).prependTo("#log");
            $("#log").scrollTop(0);
        }
        $("#actors").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{route('searchActor')}}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                log("Selected: " + ui.item.title + " aka " + ui.item.id);
                window.location.href = '/actors/' + ui.item.id
            }
        });
    });
</script>
</html>
