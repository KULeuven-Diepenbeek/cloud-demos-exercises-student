<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel + Flask API Integration backend</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <h1>User List</h1>
    <ul class="list-group" id="users-list">
        @foreach ($users as $user)
        <li class="list-group-item">
            {{ $user['name'] }} - {{ $user['email'] }}
        </li>
        @endforeach
    </ul>
    </div>
</body>
</html>
