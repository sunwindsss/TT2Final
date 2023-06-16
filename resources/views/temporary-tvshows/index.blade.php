<!DOCTYPE html>
<html>
<head>
    <title>Temporary TV Shows</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>All Temporary TV Shows</h1>
        <ul>
            @foreach ($temporaryTVShows as $temporaryTVShow)
                <li>
                    {{ $temporaryTVShow->name }} - Score: {{ $temporaryTVShow->fixed_score }}
                    <ul>
                        @foreach ($temporaryTVShow->actors as $actor)
                            <li>{{ $actor->full_name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
