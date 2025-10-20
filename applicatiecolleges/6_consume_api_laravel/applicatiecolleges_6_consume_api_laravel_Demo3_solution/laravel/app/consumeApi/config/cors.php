<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],  // Geeft aan voor welke routes CORS ingeschakeld moet worden

    'allowed_methods' => ['*'], // Toegestane HTTP-methoden zoals GET, POST, PUT, DELETE. '*' staat voor alle methoden

    'allowed_origins' => ['*'], // Toegestane origins. '*' betekent dat elke origin is toegestaan

    'allowed_origins_patterns' => [], // Regex-patronen voor meer specifieke origin matching

    'allowed_headers' => ['*'], // Headers die zijn toegestaan in CORS-verzoeken

    'exposed_headers' => [], // Headers die zichtbaar zijn in de client (bijvoorbeeld 'Authorization')

    'max_age' => 0, // Hoe lang de resultaten van een preflight request worden gecached (in seconden)

    'supports_credentials' => false, // Als je cookies of authorization headers toestaat, zet deze op true

];