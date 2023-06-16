<!DOCTYPE html>
<html>
<head>
    <title>Temporary TV Shows</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>All Temporary TV Shows</h1>
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
