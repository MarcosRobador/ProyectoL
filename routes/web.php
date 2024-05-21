<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZapatillaController;

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
    return view('welcome');
});

//  Pide que el correo electrónico sea verificado
Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware(['auth', 'verified']);

Route::resource('zapatillas', ZapatillaController::class);

Route::get('/index', function () {
    return view('index');
});


Route::get('/zapatillas', [ZapatillaController::class, 'index'])
    ->name('zapatillas.index')
    ->middleware('role:admin');

Route::get('/ejemplo', function () {
    return view('ejemplo');
})->name('ejemplo');

