<!DOCTYPE html>
<html>
<head>
    <title>My Watchlist</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-family: "Inter", sans-serif;
            font-size: 40px;
            margin-top: 20px;
        }

        .tv-show {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .tv-show img {
            width: 200px;
            height: auto;
            margin-bottom: 10px;
        }

        .tv-show .title {
            font-family: "Inter", sans-serif;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .tv-show .remove-watchlist {
            background-color: gold;
            color: black;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }

        .back-to-main-page {
            font-family: "Inter", sans-serif;
            font-size: 16px;
            color: gold;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">My Watchlist</h1>
        <div class="tv-show-list">
            @foreach ($watchlist as $watchlistEntry)
                <div class="tv-show">
                    <img src="{{ asset('storage/' . $watchlistEntry->show->picture) }}" alt="TV Show Picture">
                    <div class="show-info">
                        <h2 class="title">{{ $watchlistEntry->show->name }}</h2>
                        <form action="{{ route('watchlist.remove', $watchlistEntry->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-watchlist" onclick="storeScrollPosition()">Remove from watchlist</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <p ><a href="{{ route('home') }}" class="back-to-main-page">Back to main page</a></p>
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
