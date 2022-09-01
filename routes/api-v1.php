<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [\App\Http\Controllers\API\v1\Registration\Controller::class, 'run']);
