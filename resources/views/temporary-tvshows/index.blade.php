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

        h1 {
            font-family: "Inter", sans-serif;
            font-size: 40px;
            margin-top: 20px;
        }

        /* border-bottom creates the white line effect */ 
        .tv-show {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .rating-info {
            display: flex;
            align-items: center;
        }

        .rating-info .score {
            margin-bottom: 0;
            margin-right: 10px;
        }

        /* Delete button is styled with a red background color, to make it stand out */
        .delete-rating {
            background-color: red;
            color: white;
            border: none;
            padding: 3px 8px;
            border-radius: 3px;
            cursor: pointer;
        }

        .add-watchlist {
            background-color: gold;
        }

        .remove-watchlist {
            background-color: red;
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
        <h1 class="title">TV Show Tracker</h1>
        <!-- Code for listing each TV Show and Actors, and Ratings -->
        <div class="tv-show-list" id="tv-show-list">
            @foreach ($temporaryTVShows as $temporaryTVShow)
                <div class="tv-show">
                    <!-- Grabs TV show image using the image path from the database -->
                    <img src="{{ asset('storage/' . $temporaryTVShow->picture) }}" alt="TV Show Picture">
                        <div class="show-info">
                            <h2 class="title">{{ $temporaryTVShow->name }}</h2>
                            <p class="score">Score: <span>{{ $temporaryTVShow->fixed_score }}</span></p>
                            <ul>
                                <!-- Lists actors -->
                                @foreach ($temporaryTVShow->actors as $actor)
                                    <li>{{ $actor->full_name }}</li>
                                @endforeach
                            </ul>
                            <!-- User authentication check for TV show ratings -->
                            @auth
                                <!-- If user is authenticated and has a personal rating, then display it (along with a delete button) -->
                                @if ($temporaryTVShow->ratings->contains('user_id', auth()->id()))
                                    @php
                                        $userRating = $temporaryTVShow->ratings->firstWhere('user_id', auth()->id());
                                    @endphp
                                    <div class="rating-info">
                                        <p class="score">My rating: <span>{{ intval($userRating->rating) }}</span></p>
                                        <form action="{{ route('tvshows.rate.delete', ['rating' => $userRating->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-rating" onclick="storeScrollPosition()" style="margin-top: 15px;"><strong>X</strong></button>
                                        </form>
                                    </div>
                                <!-- If user is authenticated but has no personal rating, display a field to input the rating -->
                                @else
                                    <form action="{{ route('tvshows.rate', ['tvshow' => $temporaryTVShow->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="rating">Rate this show:</label>
                                            <input type="number" name="rating" id="rating" min="1" max="10" step="1" required style="width: 35px;">
                                            <input type="hidden" name="tv_show_id" value="{{ $temporaryTVShow->id }}">
                                            <button type="submit" onclick="storeScrollPosition()">Rate</button>
                                        </div>
                                    </form>
                                @endif
                                <!-- In other case (user has not authenticated) display a message that notifies the user about the rating functionality -->
                                @else
                                    <p>Please <a href="{{ route('login') }}" style="color: gold; text-decoration: underline;">login</a> to rate and add shows to a watchlist!</p>
                            @endauth
                            <!-- User authentication check for TV show watchlists -->
                            @auth
                                @php
                                    $watchlistEntry = auth()->user()->watchlist->where('show_id', $temporaryTVShow->id)->first();
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
                                        <form action="{{ route('watchlist.add', $temporaryTVShow->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="add-watchlist" onclick="storeScrollPosition()">Add to watchlist</button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Script that moves the scrolling position to the place from where you clicked any buttons, to ensure comfortable site usage -->
    <script>
        // Check if there is a stored scroll position
        var storedScrollPosition = localStorage.getItem('scrollPosition');
        if (storedScrollPosition) {
            // Scroll to the stored position after the page loads
            window.onload = function () {
                window.scrollTo(0, storedScrollPosition);

                // Clear the stored scroll position
                localStorage.removeItem('scrollPosition');
            };
        }

        // Function to store the scroll position
        function storeScrollPosition() {
            localStorage.setItem('scrollPosition', window.pageYOffset);
        }
    </script>
</body>
</html>
