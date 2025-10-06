<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Softonic\GraphQL\ClientBuilder;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/graphQl_1', function () {
    # Create the client with the correct URL for the graphQl api
    $client = ClientBuilder::build('https://spacex-production.up.railway.app/');
    # Define the correct query
    $query = 'query ExampleQuery {
        company {
          ceo
        }';
    # Define the variables, if none needed make this an empty array
    $variables = [];
    # Execute the request
    $response = $client->query($query,$variables);
    # Log the response
    dd($response);
});

Route::get('/graphQl_2', function () {
    $client = ClientBuilder::build('https://spacex-production.up.railway.app/');
    # The beauty of QraphQL is that you can query just the data you need in the client, so no under- or overfetching
    $query = 'query ExampleQuery {
            company {
                ceo
            }
            roadster {
                mars_distance_km
            }   
        }';

    $variables = [];

    $response = $client->query($query,$variables);
    dd($response);
});

Route::get('/graphQl_3', function () {
    $client = ClientBuilder::build('https://spacex-production.up.railway.app/');

    $query = 'query Query($dragonId: ID!) {
                dragon(id: $dragonId) {
                    active
                    description
                    first_flight
                }
            }';
    # Define the variables in JSON format
    $variables = ["dragonId"=> "5e9d058759b1ff74a7ad5f8f"];

    $response = $client->query($query,$variables);
    # Unpack the response inside of PHP
    dd($response->getData()["dragon"]);
});