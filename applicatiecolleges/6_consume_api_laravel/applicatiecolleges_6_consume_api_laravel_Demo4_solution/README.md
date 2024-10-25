# Solution steps: 
## Laravel project als frontend, die gegevens ophaalt via calls naar een SOAP api

1. Run de docker-compose file om een developer container te starten. Dit doe je door te navigeren in een terminal naar deze directory en het volgende commando te runnen: `docker-compose up -d`. (Zorg ervoor dat je docker desktop aan het runnen is. Voor linux kan het zijn dat je `sudo` moet gebruiken)
    - Wil je meer info over wat er in containers gebeurt? Laat dan de `-d` weg om de logs van elke container te zien in de terminal. Let er wel op dat de containers nu zullen stoppen wanneer je de terminal sluit.

2. Kijk goed naar de docker-compose file of gebruik het commando `docker ps -a` om te kijken wat de naam van je Laravel container te vinden. Gebruik die naam in het volgende commando om een shell te openen in de container: `docker exec -it <mijnContainerNaam> /bin/bash`

3. Om requests te maken vanuit de PHP backend, hebben we volgende Laravel module nodig `Guzzle` deze module voeg je aan je Laravel project toe door het volgende commando te runnen in de Laravel container in de directory van je Laravel project: `composer require guzzlehttp/guzzle`

4. Aangezien we een zeer simpele call gaan demonstreren, kunnen we alle functionaliteit in 1 view (`views/soap.blade.php`) en de `route/web.php` definiëren. (de code voor beide files is op de website terug te vinden of hier in de oplossing)
    - de inhoud van het request dat we gaan moeten sturen naar de SOAP service kan je simpelweg via de Chrome Extentie `Wizdler` onderzoeken.
    - Je kan nu je Laravel project opstarten met: `php artisan serve --host 0.0.0.0` (host 0.0.0.0 is belangrijk omdat je anders vanuit de host webbrowser je de container niet kan bereiken)
    - surf naar `http://localhost:8000/soapAdd` om je webpagina te bekijken.
    

