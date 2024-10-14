@extends('layouts.app')

@section('content')
    <h1>User List</h1>
    <ul class="list-group" id="users-list">
        <!-- Users will be populated here by JavaScript -->
    </ul>

    <hr>
    <h2>Add User</h2>
    <form id="add-user-form" onsubmit="addUser(event)">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
@endsection

@section('scripts')
    <script>
        async function addUser(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;

            try {
                let response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ name: name, email: email })
                });

                if (response.ok) {
                    alert('User added successfully');
                    document.getElementById('add-user-form').reset();
                    fetchUsers();  // Refresh user list
                } else {
                    alert('Error adding user');
                }
            } catch (error) {
                console.error('Error adding user:', error);
            }
        }
    </script>
@endsection
