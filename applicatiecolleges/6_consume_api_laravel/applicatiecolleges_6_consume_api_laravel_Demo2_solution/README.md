# Solution steps: 
## Laravel project als frontend, die gegevens ophaalt via calls naar een Flask REST-api (Vanuit de backend met PHP)

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.
    - Vergeet ook weer niet de flask applicatie te starten nadat je de requirements hebt geïnstalleerd op de container met `pip install -r requirements.txt`
    - Merk op dat de Flask app nu ook in dezelfde docker-compose file staat aangezien de applicaties via de backend anders niet met elkaar kunnen communiceren.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. We vertrekken van het einde van demo 1 en maken nu een ander endpoint en view aan om gegevens op te vragen aan de Flask API vanuit de backend nu met PHP. 

4. Het doen van requests die niets te maken hebben met het serveren van webpagina's steken we in een andere route genaamd `api.php`. Maak deze aan via `php artisan install:api`. Meer info [hier](https://laravel.com/docs/11.x/routing)
    - een call naar `.../api/user` wordt gedefinieerd in `api.php` als `Route::post(/user, ...)` bijvoorbeeld. In de `api.php` moet/mag je dus niet `/api` voor het endpoint typen.

5. Om requests te maken vanuit de PHP backend, hebben we volgende Laravel module nodig `Guzzle` deze module voeg je aan je Laravel project toe door het volgende commando te runnen in de Laravel container in de directory van je Laravel project: `composer require guzzlehttp/guzzle`

6. We passen nu onze view `resources/views/users.blade.php` aan om niet meer via Javascript calls te maken naar de api. Maar nu gaan we calls doen naar lokale Laravel endpoints die dan in de backend een oproep gaan doen naar de Flask applicatie en de juiste data teruggeven. De aangepaste view vind je terug op de website of hier in de oplossing.

7. Nu moeten we die lokale endpoints nog definiëren in de `routes/api.php`. We kunnen de functionaliteit helemaal in deze file steken maar om een beter overzicht te bewaren gaan we wat uitgevoerd moet worden bij elk endpoint in een `FlaskUserController` definiëren. Je kan wel al de routes (`api.php` code) aanmaken zoals in de code op de website of hier in de oplossing.

7. Nu rest ons enkel de functionaliteiten van de lokale endpoints uit te schrijven in onze `FlaskUserController`. Omdat we deze users van Flask halen en die daar beheert worden is het niet nodig om hiervoor in Laravel ook modellen voor aan te maken. Enkel een controller die de calls maakt naar de Flask api is voldoende. Maak die `app/Http/Controllers/FlaskUsersController.php` aan via het commando: `php artisan make:controller FlaskUserController`. De code voor dit bestand kan je weer terugvinden op de website of hier in de oplossing.
    - (zie website en oplossing om te kijken via welke code we dit doen in Laravel)
    - Je kan nu je Laravel project opstarten met: `php artisan serve --host 0.0.0.0` (host 0.0.0.0 is belangrijk omdat je anders vanuit de host webbrowser je de container niet kan bereiken)
    - surf naar `http://localhost:8000/users` om je webpagina te bekijken.
    - Zorg er natuurlijk wel voor dat je Flask api server van demo `applicatiecolleges_5_rest_api_flask_Demo1_solution` (in hetzelfde docker netwerk) opstaat anders zal je natuurlijk niets zien. en krijg je volgende error in je webbrowser console te zien:

    ```javascript
    Error fetching users: TypeError: Failed to fetch
    at fetchUsers (users:43:38)
    ```


<!-- TODO: Delete below -->

# Rest api in laravel

php artisan make:model LaravelUser -m

Change files: Migration, Model, Controller

php artisan migrate

php artisan make:factory LaravelUserFactory --model=LaravelUser
Change files: factory
php artisan make:seeder LaravelUserSeeder
Change files: seeder

php artisan db:seed --class=LaravelUserSeeder