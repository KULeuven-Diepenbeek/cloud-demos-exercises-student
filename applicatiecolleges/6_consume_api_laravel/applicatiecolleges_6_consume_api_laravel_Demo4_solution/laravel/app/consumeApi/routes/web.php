<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Softonic\GraphQL\ClientBuilder;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/graphQl_1', function () {
    # Create the client with the correct URL for the graphQl api
    $client = ClientBuilder::build('https://countries.trevorblades.com/graphql');
    # Define the correct query
    $query = 'query ExampleQuery {
        countries {
            name
        }
    }';
    # Define the variables, if none needed make this an empty array
    $variables = [];
    # Execute the request
    $response = $client->query($query,$variables);
    # Log the response
    dd($response);
});

Route::get('/graphQl_2', function () {
    # Maak verbinding met de GraphQL API
    $client = ClientBuilder::build('https://countries.trevorblades.com/graphql');
    
    # GraphQL voordeel: je vraagt alleen de data op die je nodig hebt - geen over- of onder-fetching
    # Deze query demonstreert het ophalen van meerdere verschillende datatypes in één request
    $query = 'query ExampleQuery {
            # Haal een specifiek continent op (Europa) met alle landen
            continent(code: "EU") {
                name        # Continent naam
                countries {
                    name        # Landnaam
                    capital     # Hoofdstad
                    currency    # Valuta
                }
            }
            # Haal alle continenten op met basis informatie
            continents {
                name        # Continent naam
                code        # Continent code (bijv. EU, AS, NA)
            }   
        }';

    # Geen variabelen nodig voor deze query
    $variables = [];

    # Voer de query uit en dump het resultaat
    $response = $client->query($query,$variables);
    dd($response);
});

Route::get('/graphQl_3', function () {
    # Maak verbinding met de GraphQL API
    $client = ClientBuilder::build('https://countries.trevorblades.com/graphql');

    # Deze query demonstreert het gebruik van variabelen in GraphQL
    # Variabelen maken queries herbruikbaar en veiliger tegen injectie-aanvallen
    $query = 'query Query($countryCode: ID!) {
                # Het uitroepteken (!) betekent dat deze variabele verplicht is
                country(code: $countryCode) {
                    name            # Volledige landnaam
                    capital         # Hoofdstad
                    currency        # Valuta codes (kan meerdere zijn)
                    phone           # Internationale telefooncode
                    continent {     # Geneste object: continent informatie
                        name        # Naam van het continent
                    }
                    languages {     # Array van objecten: alle gesproken talen
                        name        # Naam van elke taal
                    }
                }
            }';
    
    # Definieer de variabelen in JSON formaat
    # Deze waarden worden veilig ingevoegd in de query waar $countryCode staat
    $variables = ["countryCode"=> "BE"]; # BE = België

    # Voer de query uit met de meegegeven variabelen
    $response = $client->query($query,$variables);
    
    # Pak specifieke data uit de response uit
    # getData() geeft de 'data' sectie terug, ["country"] pakt het land object eruit
    dd($response->getData()["country"]);
});