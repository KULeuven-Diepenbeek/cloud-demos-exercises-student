<?php

use App\Http\Controllers\FlaskUserController;

Route::get('/flaskusers', [FlaskUserController::class, 'index']);
Route::get('/users/{id}', [FlaskUserController::class, 'show']);
Route::post('/users', [FlaskUserController::class, 'store']);
Route::delete('/users/{id}', [FlaskUserController::class, 'destroy']);