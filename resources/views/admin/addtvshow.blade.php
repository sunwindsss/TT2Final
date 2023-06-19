<!DOCTYPE html>
<html>
<head>
    <title>Add TV Show</title>
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
        .form-group input[type="number"],
        .form-group input[type="file"] {
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

        .form-group input[type="file"] {
            cursor: pointer;
        }

        .form-group input[type="file"]::-webkit-file-upload-button {
            background-color: gold;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="file"]::-webkit-file-upload-button:hover {
            background-color: rgb(218, 165, 32);
        }

        .form-group input[type="file"]::-webkit-file-upload-button:active {
            background-color: rgb(184, 134, 11);
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
        <h1 class="title">Add TV Show</h1>
        <form action="{{ route('admin.tvshow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="fixed_score">Fixed Score:</label>
                <input type="number" name="fixed_score" id="fixed_score" min="0.1" max="10.0" step="0.1" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" name="picture" id="picture" required accept="image/*">
            </div>
            <button type="submit">Add TV Show</button>
        </form>
        <p class="back-link" onclick="window.location.href='{{ route('admin.admin') }}'">Back to Admin Panel</p>
    </div>
</body>
</html>
