<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\InstallerController;

// basic routes for app registration
Route::post('register', [AppController::class, 'register']);
Route::post('environment', [AppController::class, 'setEnvironment']);
Route::post('file', [AppController::class, 'searchFile']);
Route::post('write/file', [AppController::class, 'writeFile']);

Route::get('test', [InstallerController::class, 'install']);
