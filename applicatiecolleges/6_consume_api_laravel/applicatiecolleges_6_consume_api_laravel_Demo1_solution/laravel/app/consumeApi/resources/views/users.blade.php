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
    <h1>User List</h1>
    <ul class="list-group" id="users-list">
        <!-- Users will be populated here by JavaScript -->
    </ul>

    <!-- Input field so new users can be created or old ones updated -->
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
    </div>

    <script>
        // Voer de functie fetchUsers uit wanneer deze pagina geladen wordt.
        window.onload = fetchUsers;

        // HTTP GET request
        // async want we willen niet dat onze website blijft hangen totdat je antwoord hebt gekregen van de API
        async function fetchUsers() {
            try {
                // AWAIT, wacht dus totdat de fetch iets heeft teruggeven en steek dit dan in de variabele respons
                // De fetch functie gebruikt standaard GET requests
                let response = await fetch(`http://localhost:5000/api/users?pwd=mypassword`);
                // response bevat meer informatie, maar we zijn eigenlijk enkel geinteresseerd in de data die we terugkrijgen in JSON formaat
                let data = await response.json();
                // Maak nu mooie html code aan om elke gebruiker te tonen
                displayUsers(data);
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        }

        // Maak mooie html code aan om elke gebruiker te tonen
        function displayUsers(users) {
            let usersList = document.getElementById('users-list');
            // delete alle inhoud van het HTML element met id 'users-list'
            usersList.innerHTML = '';

            // maak een HTML blokje aan voor elke gebruiker (met naam, email en een delete knop) en voeg die toe aan de users-list
            users.forEach(user => {
                let listItem = `<li class="list-group-item">
                    ${user.name} - ${user.email}
                    <button class="btn btn-danger btn-sm float-end" onclick="deleteUser(${user.id})">Delete</button>
                </li>`;
                usersList.innerHTML += listItem;
            });
        }
        
        // De code die uitgevoerd moet worden wanneer op de delete knop gedrukt wordt
        async function deleteUser(userId) {
            try {
                // Specifieer dat we een DELETE HTTP request willen sturen
                let response = await fetch(`http://localhost:5000/api/users/${userId}`, {
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

        // De code die uitgevoerd moet worden om een nieuwe gebruiker aan te maken
        async function addUser(event) {
            //Zorgt ervoor dat dit event niet zomaar getriggerd wordt
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;

            try {
                // We specifieren in de HEADER op welke manier de data in de BODY gecodeerd is. Het JSON object steken we dan in de body
                let response = await fetch("http://localhost:5000/api/users", {
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
</body>
</html>