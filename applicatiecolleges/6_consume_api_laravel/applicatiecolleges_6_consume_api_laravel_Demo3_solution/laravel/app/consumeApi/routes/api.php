<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaravelUserController;

Route::get('/laravelUsers', [LaravelUserController::class, 'getLaravelUsers']);
Route::get('/laravelUsers/{id}', [LaravelUserController::class, 'getLaravelUser']);
Route::post('/laravelUsers', [LaravelUserController::class, 'createLaravelUser']);
Route::delete('/laravelUsers/{id}', [LaravelUserController::class, 'deleteLaravelUser']);