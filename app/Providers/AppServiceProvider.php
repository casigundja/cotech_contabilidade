<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Gate::define('commercial',fn(\App\Models\User $u)=>in_array($u->role,['admin','attendant']));
        \Illuminate\Support\Facades\Gate::define('content',fn(\App\Models\User $u)=>in_array($u->role,['admin','editor']));
        \Illuminate\Support\Facades\Gate::define('administration',fn(\App\Models\User $u)=>$u->role==='admin');
    }
}
