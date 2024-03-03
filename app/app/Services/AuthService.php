<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public static function getAdminUser(): User
    {
        return User::where('admin', 1)->first();
    }

    public static function hasPermission(int|string $permission): bool
    {
        return auth()->user()->hasPermissionTo($permission);
    }

    public static function hasRole(string $role): bool
    {
        return auth()->user()->hasPermissionTo($role);
    }
}
