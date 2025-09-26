
# Solution steps: 
## Creating a REST api in Flask (python)

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. Nu je in de container zit, kan je het de flask server starten met `python3 ./app.py`. Alle info over hoe de code werkt is terug te vinden op de website of in de oplossing van deze demo. (Vergeet niet dat je eerst alle dependencies in je container moet installeren via het commando in de container `pip install -r requirements.txt`, indien nodig)

4. Je kan nu de endpoints van je website bekijken via een webbrowser op de host. (Via je webbrowser kan je natuurlijk wel alleen GET requests sturen) Je zal dan gewoon JSON objecten te zien krijgen die teruggegeven worden door je API. Wanneer we de api gaan consumeren is het die JSON data die we dan verder gaan verwerken. (De andere functionaliteiten van je programma kan je ook testen met [Thunderclient](https://www.thunderclient.com/))

## SQL commands to put some dummy data in the database using Adminer

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email) VALUES 
('John Doe', 'john.doe@example.com'),
('Jane Smith', 'jane.smith@example.com'),
('Alice Johnson', 'alice.johnson@example.com'),
('Bob Brown', 'bob.brown@example.com'),
('Charlie Green', 'charlie.green@example.com'),
('Emily Davis', 'emily.davis@example.com'),
('Michael Wilson', 'michael.wilson@example.com'),
('Sarah White', 'sarah.white@example.com'),
('David King', 'david.king@example.com'),
('Laura Scott', 'laura.scott@example.com');

```
