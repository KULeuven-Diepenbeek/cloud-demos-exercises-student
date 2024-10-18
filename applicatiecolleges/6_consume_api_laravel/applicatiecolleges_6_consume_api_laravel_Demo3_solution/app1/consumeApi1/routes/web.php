<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/flask-users', function () {
    return view('flask_users');
});

Route::get('/laravel-users', function () {
    return view('laravel_users');
});

Route::get('/users', [FlaskUserController::class, 'index']);
Route::get('/users/{id}', [FlaskUserController::class, 'show']);
Route::post('/users', [FlaskUserController::class, 'store']);
Route::delete('/users/{id}', [FlaskUserController::class, 'destroy']);