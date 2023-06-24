<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Installer.Installer');
})->name('installer.home');

Route::get('/requirements', [InstallerController::class, 'requirements'])->name('installer.requirements');

Route::get('/environment', function () {
    return view('Installer.Environment');
})->name('installer.environment');

Route::post('/envsetup', [InstallerController::class, 'environment'])->name('installer.envsetup');

Route::get('/database', function () {
    return view('Installer.Database');
})->name('installer.database');

Route::get('/migrate', [InstallerController::class, 'migrate'])->name('installer.migrate');
Route::get('/initialdataset', [InstallerController::class, 'initialdataset'])->name('installer.initialdataset');
Route::get('/systemsetup', function () {
    return view('Installer.Systemsetup');
})->name('installer.systemSetup');

Route::get('/systemClean', [InstallerController::class, 'systemClean'])->name('installer.systemClean');

Route::get('/systemOptimize', [InstallerController::class, 'systemOptimize'])->name('installer.systemOptimize');

Route::get('/installcomplete', [InstallerController::class, 'installComplete'])->name('installer.complete');
