<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [\App\Http\Controllers\API\v1\Registration\Controller::class, 'run']);
Route::post('/login', [\App\Http\Controllers\API\v1\Login\Controller::class, 'run']);
Route::get('/profile', [\App\Http\Controllers\API\v1\Profile\Controller::class, 'run'])->middleware('auth');
