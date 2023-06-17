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
        <!-- Code for listing each TV Show and Actors, and Ratings -->
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
                            @auth
                                @if ($temporaryTVShow->ratings->contains('user_id', auth()->id()))
                                    @php
                                        $userRating = $temporaryTVShow->ratings->firstWhere('user_id', auth()->id());
                                    @endphp
                                    <div class="rating-info">
                                        <p class="score">My rating: <span>{{ intval($userRating->rating) }}</span></p>
                                        <form action="{{ route('tvshows.rate.delete', ['rating' => $userRating->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-rating">X</button>
                                        </form>
                                    </div>
                                @else
                                    <form action="{{ route('tvshows.rate', ['tvshow' => $temporaryTVShow->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="rating">Rate this show:</label>
                                            <input type="number" name="rating" id="rating" min="1" max="10" step="1" required>
                                            <input type="hidden" name="tv_show_id" value="{{ $temporaryTVShow->id }}">
                                        </div>
                                        <button type="submit">Rate</button>
                                    </form>
                                @endif
                                @else
                                    <p>Please <a href="{{ route('register') }}">register</a> to rate shows.</p>
                            @endauth
                        </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
