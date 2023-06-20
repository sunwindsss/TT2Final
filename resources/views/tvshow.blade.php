<!DOCTYPE html>
<html>
<head>
    <title>TV Show Details</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
    <style>
        body {
            text-align: center;
            font-family: "Inter", sans-serif;
        }

        h1.title {
            font-size: 40px;
            margin-top: 20px;
        }

        /* border-bottom creates the white line effect between each TV show listing */ 
        .tv-show {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .score {
            color: gold;
            font-weight: bold;
        }

        .rating-info {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .rating-info .score {
            margin-bottom: 0;
            margin-right: 10px;
            color: gold;
        }

        /* Delete button is styled with a red background color, to make it stand out */
        .delete-rating {
            background-color: red;
            color: white;
            border: none;
            padding: 3px 8px;
            border-radius: 3px;
            margin-top: 17px;
            cursor: pointer;
        }

        .add-watchlist,
        .remove-watchlist {
            background-color: rgb(255, 201, 201);
            font-size: 16px;
            font-weight: bold;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-watchlist {
            background-color: gold;
        }

        .rate {
            background-color: gold;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        a {
            color: gold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">{{ $tvshow->name }}</h1>
        <img src="{{ asset('storage/' . $tvshow->picture) }}" alt="TV Show Picture">
        <p class="score">Score: <span>{{ $tvshow->fixed_score }}</span></p>
        <p class="description">{{ $tvshow->description }}</p>
        <h3>Actors:</h3>
        <ul>
            @foreach ($tvshow->actorsInShows as $actorsInShow)
                <li>{{ $actorsInShow->actor->full_name }}</li>
            @endforeach
        </ul>

        <!-- User authentication check for TV show ratings -->
        @auth
            <!-- If user is authenticated and has a personal rating, then display it (along with a delete button) -->
            @if ($tvshow->ratings->contains('user_id', auth()->id()))
                @php
                    $userRating = $tvshow->ratings->firstWhere('user_id', auth()->id());
                @endphp
                <div class="rating-info">
                    <p class="score">My rating: <span>{{ intval($userRating->rating) }}</span></p>
                    <form action="{{ route('tvshows.rate.delete', ['rating' => $userRating->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-rating" onclick="storeScrollPosition()"><strong>X</strong></button>
                    </form>
                </div>
            <!-- If user is authenticated but has no personal rating, display a field to input the rating -->
            @else
                <form action="{{ route('tvshows.rate', ['tvshow' => $tvshow->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rating">Rate this show:</label>
                        <input type="number" name="rating" id="rating" min="1" max="10" step="1" required style="width: 35px;">
                        <input type="hidden" name="tv_show_id" value="{{ $tvshow->id }}">
                        <button type="submit" class="rate" onclick="storeScrollPosition()">Rate</button>
                    </div>
                </form>
            @endif
        <!-- In other case (user has not authenticated) display a message that notifies the user about the rating functionality -->
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to rate and add shows to a watchlist!</p>
        @endauth

        <!-- User authentication check for TV show watchlists -->
        @auth
            @php
                $watchlistEntry = auth()->user()->watchlist->where('show_id', $tvshow->id)->first();
            @endphp
            <br>
            <div class="watchlist-button">
                @if ($watchlistEntry)
                    <form action="{{ route('watchlist.remove', $watchlistEntry->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-watchlist" onclick="storeScrollPosition()">Remove from watchlist</button>
                    </form>
                @else
                    <form action="{{ route('watchlist.add', $tvshow->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="add-watchlist" onclick="storeScrollPosition()">Add to watchlist</button>
                    </form>
                @endif
            </div>
        @endauth

        <br>
        <a href="{{ route('home') }}">Back to main page</a>
    </div>

    <!-- Add any required JavaScript code -->
</body>
</html>
