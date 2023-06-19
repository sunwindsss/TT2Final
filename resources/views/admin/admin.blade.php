<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - TV Tracker</title>
    <link rel="stylesheet" href="{{ asset('css/temp-styles.css') }}">
    <style>
        .admin-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: black;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .admin-container::before {
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
        
        .admin-title {
            font-family: "Inter", sans-serif;
            font-size: 40px;
            margin-top: 20px;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .admin-button {
            background-color: gold;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .admin-buttons {
            display: flex;
            justify-content: center;
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
    <div class="admin-container">
        <h1 class="admin-title">TV Tracker Admin Panel</h1>
        <div class="admin-buttons">
            <form action="{{ route('admin.tvshow.create') }}" method="GET">
                <button class="admin-button" type="submit">Add TV Show</button>
            </form>
            <form action="{{ route('admin.actor.create') }}" method="GET">
                <button class="admin-button" type="submit">Add Actor</button>
            </form>
            <form action="{{ route('admin.linkactor') }}" method="GET">
                <button class="admin-button" type="submit">Link Actor to Show</button>
            </form>
            <form action="{{ route('admin.users') }}" method="GET">
                <button class="admin-button" type="submit">Registered Users</button>
            </form>
        </div>
        <div class="admin-buttons">
            <form action="{{ route('admin.tvshow.delete.create') }}" method="GET">
                <button class="admin-button" type="submit">Delete TV Show</button>
            </form>
            <form action="{{ route('admin.actor.delete') }}" method="GET">
                <button class="admin-button" type="submit">Delete Actor</button>
            </form>
        </div>
        <p class="back-link" onclick="window.location.href='{{ route('home') }}'">Back to main page</p>
    </div>
</body>
</html>
