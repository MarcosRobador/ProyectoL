<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZapatillaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;



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

Route::get('/zapatillasUser', [ZapatillaController::class, 'userIndex'])
    ->name('user.zapatillas.index');


Route::get('/', [ZapatillaController::class, 'welcome'])->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');

Route::get('/zapatillasUser/{id}', [ZapatillaController::class, 'showUser'])
    ->name('user.zapatillas.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth');
