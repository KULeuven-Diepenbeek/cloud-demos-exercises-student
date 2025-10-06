# Solution steps: 
## Laravel project als frontend, die gegevens ophaalt via calls naar de Laravel REST-api

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.
    - Merk op dat we dus geen Flask container meer nodig hebben.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. We vertrekken van het einde van demo 2 en maken nu een nieuwe REST api, maar nu dan in Laravel. Om dit te doen maken we een nieuwe routes file aan genaamd `routes/api.php`. Hier gaan we onze API endpoints definiëren net zoals in de flask api. (Om het verschil te kunnen zien met de flask api zullen we de gebruikers die we opslaan in de Laravel REST api, `LaravelUsers` noemen). 
    - hiermee kunnen we dan later HTTP requests doen naar `http://localhost:8000/api/...`


5. We passen nu weer view `resources/views/users.blade.php` aan om niet meer via Javascript calls te maken naar de api. Maar nu gaan we calls doen naar lokale Laravel endpoints die dan in de backend een oproep gaan doen naar de Flask applicatie en de juiste data teruggeven. De aangepaste view vind je terug op de website of hier in de oplossing.

6. Nu moeten we die lokale endpoints nog definiëren in de `routes/api.php` (De code voor deze file vind je weer op de website of hier in de oplossing). We kunnen de functionaliteit helemaal in deze file steken maar om een beter overzicht te bewaren gaan we wat uitgevoerd moet worden bij elk endpoint in een `LaravelUserController` definiëren. Omdat we nu ook effectief de data in de Laravel database willen opslaan zullen we ook een `LaravelUser` model moeten aanmaken en een `migration_table`.
    - we kunnen dit Model, die Controller en migration table (en Factory) simpel aanmaken met 1 commando: `php artisan make:model LaravelUser -mc --Factory`

7. Nu rest ons enkel de functionaliteiten van het model en migration tabel te coderen. (zie website of oplossing voor de code. We doen hier niets meer dan PHP klassen definiëren en koppelen aan de database met de migration table). Daarna kunnen we de functionaliteiten van de api endpoints uit schrijven in onze `LaravelUserController`. De code voor dit bestand kan je weer terugvinden op de website of hier in de oplossing.
    - Sinds we een nieuwe migration table hebben moet je nog eens `php artisan migrate` in de terminal uitvoeren.
    - De model file vind je terug onder: `/app/models/LaravelUser.php`
    - De controller file vind je terug onder: `/app/Http/controllers/LaravelUserController.php`
    - De migration table vind je terug onder: `/database/migrations/XXXX_XX_XX_XXXXXX_create_laravel_users_table`
    - (zie website en oplossing om te kijken via welke code we dit doen in Laravel)

8. Allerlaatste stap is nog aan Laravel laten weten dat we een api route hebben. Dit doe je door de file `app/Providers/AppServiceProvider.php` aan te passen zoals op de website (of hier in de oplossing).
    - Je kan nu je Laravel project opstarten met: `php artisan serve --host 0.0.0.0` (host 0.0.0.0 is belangrijk omdat je anders vanuit de host webbrowser je de container niet kan bereiken)
    - surf naar `http://localhost:8000/users` om je webpagina te bekijken.
    - Je database gaat nog leeg zijn. Dus probeer er eens een user in te steken. Je kan ook met Factories en Seeders werken om dummy data in te stellen. Daarover vind je meer op de website.
    

