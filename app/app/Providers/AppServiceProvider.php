<?php

namespace App\Providers;

use App\Models\Team;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
		if (config('app.ssl_enabled')) {
			$url->forceScheme('https');
		}

        Blade::if('hasRole', function (string $role): bool {
            $user = Auth::user();
            if (!$user) return redirect()->route('login');
            if($user->isAdmin()) return true;
            return $user->hasRole($role);
        });

        Blade::if('hasPermission', function (string $permission): bool {
            $user = Auth::user();
            if (!$user) return redirect()->route('login');
            if($user->isAdmin()) return true;
            return $user->hasPermissionTo($permission);
        });

        Blade::if('isAdmin', function (): bool {
            $user = Auth::user();
            if (!$user) return redirect()->route('login');
            return $user->isAdmin();
        });
    }
}
