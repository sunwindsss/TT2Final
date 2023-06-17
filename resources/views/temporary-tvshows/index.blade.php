<!DOCTYPE html>
<html>
<head>
    <title>TV Trekeris!</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
    <style>
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .top-right a, .top-right button {
            background-color: yellow;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            margin-left: 5px;
        }

        .top-right form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-right">
        <!-- Authorization check for whether a visitor is authorized (login) -->    
            @if (Auth::check())
                <!-- Show logout button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                <!-- My Profile / Dashboard button -->
                <a href="{{ route('dashboard') }}">My Profile</a>
            @else
                <!-- Show login and register buttons -->
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
        <h1>TV Show Tracker</h1>
        <!-- Code for listing each TV Show and Actors -->
        <div class="tv-show-list">
            @foreach ($temporaryTVShows as $temporaryTVShow)
                <div class="tv-show">
                    <img src="{{ asset('storage/' . $temporaryTVShow->picture) }}" alt="TV Show Picture">
                    <div class="show-info">
                        <h2 class="title">{{ $temporaryTVShow->name }}</h2>
                        <p class="score">Score: <span>{{ $temporaryTVShow->fixed_score }}</span></p>
                        <ul>
                            @foreach ($temporaryTVShow->actors as $actor)
                                <li>{{ $actor->full_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
