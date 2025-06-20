<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', fn(User $user) => $user->role->name === 'admin');
        Gate::define('isPegawai', fn(User $user) => $user->role->name === 'pegawai');
        Gate::define('isPemilik', fn(User $user) => $user->role->name === 'pemilik');
    }
}
