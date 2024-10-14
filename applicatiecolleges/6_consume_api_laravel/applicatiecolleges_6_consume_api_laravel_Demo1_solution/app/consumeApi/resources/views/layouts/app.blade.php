<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel + Flask API Integration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>

    <script>
        const apiUrl = 'http://localhost:5000/api/users';  // URL of Flask API

        async function fetchUsers() {
            try {
                let response = await fetch(`${apiUrl}?pwd=mypassword`);
                let data = await response.json();
                displayUsers(data);
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        }

        function displayUsers(users) {
            let usersList = document.getElementById('users-list');
            usersList.innerHTML = '';

            users.forEach(user => {
                let listItem = `<li class="list-group-item">
                    ${user.name} - ${user.email}
                    <button class="btn btn-danger btn-sm float-end" onclick="deleteUser(${user.id})">Delete</button>
                </li>`;
                usersList.innerHTML += listItem;
            });
        }

        async function deleteUser(userId) {
            try {
                let response = await fetch(`${apiUrl}/${userId}`, {
                    method: 'DELETE'
                });
                if (response.ok) {
                    alert('User deleted successfully');
                    fetchUsers();  // Refresh list
                }
            } catch (error) {
                console.error('Error deleting user:', error);
            }
        }

        window.onload = fetchUsers;
    </script>

    @yield('scripts')
</body>
</html>