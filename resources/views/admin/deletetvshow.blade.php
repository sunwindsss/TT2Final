<!DOCTYPE html>
<html>
<head>
    <title>Delete TV Show</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: black;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("/storage/tv_shows/background.png");
            background-size: cover;
            background-repeat: no-repeat;
            z-index: -1;
        }
        
        .title {
            font-family: "Inter", sans-serif;
            font-size: 40px;
            margin-top: 20px;
            margin-bottom: 40px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        button[type="submit"] {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: rgb(204, 0, 0);
        }

        button[type="submit"]:active {
            background-color: rgb(153, 0, 0);
        }

        .back-link {
            color: gold;
            text-decoration: underline;
            cursor: pointer;
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Delete TV Show</h1>
        <form action="{{ route('admin.tvshow.delete') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tv_show">TV Show:</label>
                <select name="tv_show" id="tv_show" required>
                    @foreach ($tvShows as $tvShow)
                        <option value="{{ $tvShow->id }}">{{ $tvShow->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Delete TV Show</button>
        </form>
        <p class="back-link" onclick="window.location.href='{{ route('admin.admin') }}'">Back to Admin Panel</p>
    </div>
</body>
</html>
