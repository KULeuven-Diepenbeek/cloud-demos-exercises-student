# Solution steps: 
## Laravel project als frontend, die gegevens ophaalt via calls naar een Flask REST-api (Vanuit de frontend met Javascript)

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. Nu je in de container zit, kan je laravel specifieke commando's gaan gebruiken: maak een nieuw laravel project aan met `composer create-project laravel/laravel <naamLaravelProject>`. (Dit kan even duren) Wanneer de vraag komt om een `.sqlite` database te gebruiken. Selevteer dan `No`. 
    - Ga dan naar de file `/<naamLaravelProject>/.env` en verander daar de regel `DB_CONNECTION=sqlite` naar `DB_CONNECTION=mysql`.
    - We moeten deze verandering nog doorvoeren. Navigeer naar de directory van je naamLaravelProject en run daar volgend commando in de container terminal: `php artisan migrate`. (Dit maakt de connectie aan tussen de mysql database en het Laravel project. En maakt al een aantal default tabellen aan.)

4. De project files worden nu aangemaakt in de map `app` omdat we dit in een volume gebonden hebben aan de host in de docker-compose file.

5. Nu kan je een text/code-editor in de host gebruiken om aanpassingen te maken aan het Laravel project. LET OP: commando's voor Laravel moet je nog steeds uitvoeren in een shell BINNEN IN de Laravel container. Zorg er ook voor dat je shell zich bevindt in de directory van het Laravel project anders krijg je een error zoals `no artisan found`.

6. Nu kunnen we ons Laravel project aanpassen om contact te leggen met onze Flask api via de frontend (Javascript)
    - Hiervoor heb je een view nodig in de map `/resources/views`
    - Maak een bestand aan `/resources/views/users.blade.php`
    - Hoe deze frontend code eruit ziet kan je terugvinden op de website of in de oplossing van deze demo
    - Nu moeten we in de `/routes/web.php` file nog specificeren dat we die view moeten tonen wanneer gebruikers het endpoint `/users` bezoeken. (= surfen naar `http://localhost:8000/users`)
    - (zie website en oplossing om te kijken via welke code we dit doen in Laravel)
    - Je kan nu je Laravel project opstarten met: `php artisan serve --host 0.0.0.0` (host 0.0.0.0 is belangrijk omdat je anders vanuit de host webbrowser je de container niet kan bereiken)
    - surf naar `http://localhost:8000/users` om je webpagina te bekijken.
    - Zorg er natuurlijk wel voor dat je Flask api server van demo `applicatiecolleges_5_rest_api_flask_Demo1_solution` opstaat anders zal je natuurlijk niets zien. en krijg je volgende error in je webbrowser console te zien:

    ```javascript
    Error fetching users: TypeError: Failed to fetch
    at fetchUsers (users:43:38)
    ```

**Vanuit de frontend een api oproepen is meestal niet veilig en wordt ook vaak geblokkeerd via CORS-policies vanuit de api server zelf. Daarom doen we dit in de volgende demo in de backend van Laravel met PHP**

7. Wanneer je klaar bent met deze demo/oef, vergeet dan niet de containers te stoppen en verwijderen met het commando `docker-compose down` in de juiste directory.

