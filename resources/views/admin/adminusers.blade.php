<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
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

        .user-list {
            list-style-type: none;
            padding: 0;
        }

        .user-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .user-details {
            display: flex;
            align-items: center;
        }

        .user-name {
            margin-right: 10px;
        }

        .delete-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: darkred;
        }

        .delete-confirm {
            display: none;
            margin-top: 10px;
        }

        .delete-confirm-message {
            margin-bottom: 5px;
        }

        .delete-confirm-buttons {
            display: flex;
            justify-content: flex-end;
        }

        .delete-confirm-buttons button {
            margin-left: 10px;
        }

        .back-link {
            color: gold;
            text-decoration: underline;
            cursor: pointer;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .admin-label {
            color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Registered Users</h1>
        <ul class="user-list">
            @foreach ($users as $user)
                <li class="user-list-item">
                    <div class="user-details">
                        <span class="user-name">{{ $user->name }}</span>
                        <span class="user-email">({{ $user->email }})</span>
                    </div>
                    @if ($user->role === 'admin')
                        <span class="admin-label">Admin</span>
                    @else
                        <form id="delete-form" action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button" onclick="confirmDelete(event)">Delete User</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
        <p class="back-link" onclick="window.location.href='{{ route('admin.admin') }}'">Back to Admin Panel</p>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission
            if (confirm('Are you sure you want to delete this user?')) {
                // If user confirms, proceed with deletion
                event.target.closest('form').submit();
            }
        }
    </script>
</body>
</html>
