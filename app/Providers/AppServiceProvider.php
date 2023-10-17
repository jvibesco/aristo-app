<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
    public function boot()
    {
        Gate::define('admin', function(User $user) {
            return $user->role->role === 'ADMIN';
        });
        Gate::define('marketing', function(User $user) {
            return $user->role->role === 'MARKETING';
        });
        Gate::define('engineering', function(User $user) {
            return $user->role->role === 'ENGINEERING';
        });
        Gate::define('ppic', function(User $user) {
            return $user->role->role === 'PPIC';
        });
        Gate::define('leaderProduksi', function(User $user) {
            return $user->role->role === 'LEADER PRODUKSI';
        });
        Gate::define('qc', function(User $user) {
            return $user->role->role === 'QC';
        });
        Gate::define('operator', function(User $user) {
            return $user->role->role === 'OPERATOR';
        });
    }
}
