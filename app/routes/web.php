<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::middleware('permission:admin.dashboard.list')->group(function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');


    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');


});

Route::match(['POST','GET'], '/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('login');

Route::post('/config/set-locale', [LocaleController::class, 'setLocale'])->name('set-locale');
Route::get('/config/locale', [LocaleController::class, 'getLocaleMessages'])->name('get-locale');
