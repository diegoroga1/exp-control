<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::post('/profile',[ProfileController::class,'save'])->name('profile.save');


Route::get('/transactions',[TransactionController::class,'getTransaction'])->name('transactions.list');
