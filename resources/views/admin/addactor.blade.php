<!DOCTYPE html>
<html>
<head>
    <title>Add Actor</title>
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

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px 0px;
            border-radius: 5px;
            background-color: #333;
            color: white;
            border: none;
        }

        .form-group textarea {
            height: 100px;
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
        <h1 class="title">Add Actor</h1>
        <form action="{{ route('admin.actor.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" required>
            </div>
            <div class="form-group">
                <label for="biography">Biography:</label>
                <textarea name="biography" id="biography" required></textarea>
            </div>
            <button type="submit">Add Actor</button>
        </form>
        <p class="back-link" onclick="window.location.href='{{ route('admin.admin') }}'">Back to Admin Panel</p>
    </div>
</body>
</html>
