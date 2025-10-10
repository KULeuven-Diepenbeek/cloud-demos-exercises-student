<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskUserController;
use GuzzleHttp\Client;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/usersBackend', function () {
    // Maak een HTTP-verzoek naar de Flask API
    // uri is de flask service uit onze docker-compose
    $client = new Client(['base_uri' => 'api:5000']);
    // GET alle users op endpoint /api/users met als parameter pwd=mypassword
    $response = $client->get('/api/users', [
        'query' => ['pwd' => 'mypassword']
    ]);
    $users = json_decode($response->getBody()->getContents(), true);   
    // Stuur de lijst van gebruikers naar de view
    return view('usersBackend', ['users' => $users]);
});

Route::get('/flaskusers', [FlaskUserController::class, 'index']);
Route::get('/users/{id}', [FlaskUserController::class, 'show']);
Route::post('/users', [FlaskUserController::class, 'store']);
Route::delete('/users/{id}', [FlaskUserController::class, 'destroy']);

Route::get('/users-via-backend',function () {
    return view('users-via-backend');
});

// EXAMPLE of how you can test your code...
Route::get('/testing',function () {
    $controller = new FlaskUserController();
    $result = $controller->index(request());
    dd($result); // Dump and die
});
