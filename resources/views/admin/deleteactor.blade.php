<!DOCTYPE html>
<html>
<head>
    <title>Delete Actor</title>
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

        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #333;
            color: white;
            border: none;
        }

        button[type="submit"] {
            background-color: gold;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: rgb(218, 165, 32);
        }

        button[type="submit"]:active {
            background-color: rgb(184, 134, 11);
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
        <h1 class="title">Delete Actor</h1>
        <form action="{{ route('admin.actor.destroy') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="actor">Actor:</label>
                <select name="actor" id="actor" required>
                    @foreach ($actors as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Delete Actor</button>
        </form>
        <a href="{{ route('admin.admin') }}" class="back-link">Back to Admin Panel</a>
    </div>
</body>
</html>
