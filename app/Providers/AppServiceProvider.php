<?php

namespace App\Providers;

use App\Policies\CommandePolicy;
use Illuminate\Support\Facades\Gate;
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

        // on enregistre notre gate afin de faire une vérification à la modification
        Gate::define('update-commande', [CommandePolicy::class, 'update']);
    }
}
