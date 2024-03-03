<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\PermissionController;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\UserController;

Route::middleware('permission:admin.granted')->group(function () {
    Route::prefix('permissions')->group(function(){
        Route::get('/',[PermissionController::class,'listData'])->name('permissions');
        Route::get('/groups',[PermissionController::class,'getGroups'])->name('permissions.groups');
        Route::post('/',[PermissionController::class,'save'])->name('permissions.save');
        Route::get('/grouped',[PermissionController::class,'listGroups'])->name('permissions.groups');
        Route::get('/{permission}',[PermissionController::class,'getPermissionData'])->name('permissions.details');
        Route::post('/{permission}/users',[PermissionController::class,'syncUsers'])->name('permissions.users');
        Route::delete('/{permission}',[PermissionController::class,'delete'])->name('permissions.delete');
    });

    Route::prefix('roles')->group(function(){
        Route::get('/',[RoleController::class,'getRoles'])->name('roles');
        Route::post('/',[RoleController::class,'save'])->name('roles.save');
        Route::post('/{role}/permissions',[RoleController::class,'syncPermissions'])->name('permissions');
        Route::post('/{role}/users',[RoleController::class,'syncUsers'])->name('users');
        Route::get('/{role}',[RoleController::class,'getRoleData'])->name('roles.show');
        Route::delete('/{role}',[RoleController::class,'delete'])->name('roles.delete');
    });

    Route::prefix('users')->group(function(){
        Route::get('/',[UserController::class,'getList'])->name('users');
        Route::post('/',[UserController::class,'save'])->name('users.save');
        Route::delete('/{user}',[UserController::class,'delete'])->name('users.delete');
    });
});
