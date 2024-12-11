<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/users',function () {
    return view('users');
});


