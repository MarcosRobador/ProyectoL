<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZapatillaController;
use Illuminate\Support\Facades\Auth;


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


Route::prefix('admin')->group(function () {
    Route::resource('zapatillas', ZapatillaController::class);
});

Route::get('/index', function () {
    return view('index');
});


Route::get('/zapatillasAdmin', [ZapatillaController::class, 'index'])
    ->name('admin.zapatillas.index')
    ->middleware('role:admin');

Route::get('/zapatillasUser', function () {
    return view('user.zapatillas.index');
})->name('user.zapatillas.index');


Route::get('/', [ZapatillaController::class, 'welcome'])->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');
