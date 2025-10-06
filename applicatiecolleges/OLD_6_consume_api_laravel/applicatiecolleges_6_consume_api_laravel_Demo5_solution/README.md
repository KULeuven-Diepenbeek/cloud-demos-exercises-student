# Solution steps: 
## Laravel project als frontend, die gegevens ophaalt via calls naar een GraphQL api

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. Om requests te maken vanuit de PHP backend, hebben we volgende Laravel module nodig `Guzzle` deze module voeg je aan je Laravel project toe door het volgende commando te runnen in de Laravel container in de directory van je Laravel project: `composer require guzzlehttp/guzzle`. In dit geval bestaat er ook nog een specifiekere module die we kunnen gebruiken gebaseerd op 'Guzzle' om specifiek `GraphQL api's` http-requests te sturen, genaamd [`PHP GraphQL Client`](https://github.com/softonic/graphql-client). Deze module voeg je aan je Laravel project toe door het volgende commando te runnen in de Laravel container in de directory van je Laravel project: `composer require softonic/graphql-client`.

4. Aangezien we een zeer simpele call gaan demonstreren, kunnen we alle functionaliteit in de `route/web.php` definiëren. (de code voor de file is op de website terug te vinden of hier in de oplossing). We gebruiken in dit voorbeeld geen view-, maar gaan enkel de data laten weergeven met behulp van het PHP `dd()`-commando om te demonstreren hoe je simpel data vanuit php kan controleren.
    - de inhoud van het request dat we gaan moeten sturen zal nu GraphQL specifiek zijn. 
    - Je kan nu je Laravel project opstarten met: `php artisan serve --host 0.0.0.0` (host 0.0.0.0 is belangrijk omdat je anders vanuit de host webbrowser je de container niet kan bereiken)
    - surf naar `http://localhost:8000/graphQl_{1-3}` om je webpagina te bekijken.
    - (In deze demo maken we calls naar de SpaceX graphQL api. De documentatie en voorbeeldqueries kan je [hier](https://studio.apollographql.com/public/SpaceX-pxxbxen/variant/current/explorer) terugvinden)
    

