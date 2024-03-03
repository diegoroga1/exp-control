<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\PermissionController;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\UserController;

Route::get('/', function() {
    abort(403);
});

Route::prefix('permissions')->group(function(){
    Route::get('/',[PermissionController::class,'index'])->name('permissions');
    Route::get('/{permission}',[PermissionController::class,'show'])->name('permissions.show');
});

Route::prefix('roles')->group(function(){
    Route::get('/',[RoleController::class,'index'])->name('roles');
    Route::get('/{role}',[RoleController::class,'show'])->name('roles.show');
});

Route::prefix('users')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('users');
    Route::get('/create',[UserController::class,'create'])->name('users.create');
    Route::get('/{user_id}',[UserController::class,'edit'])->name('users.edit');
});
