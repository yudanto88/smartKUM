<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Draft;
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
        Gate::define('newuser', function (User $user) {
            return $user->role->role == '-';
        });

        Gate::define('superadmin', function (User $user) {
            return $user->role->role == 'superadmin';
        });

        Gate::define('skpd', function (User $user) {
            return $user->role->role == 'skpd';
        });

        Gate::define('admin_fo', function (User $user) {
            return $user->role->role == 'admin_fo';
        });

        Gate::define('staff_perundang_undangan', function (User $user) {
            return $user->role->role == 'staff_perundang_undangan';
        });

        Gate::define('kasubag_perundang_undangan', function (User $user) {
            return $user->role->role == 'kasubag_perundang_undangan';
        });

        Gate::define('kabag', function (User $user) {
            return $user->role->role == 'kabag';
        });

        Gate::define('kepala_dinas', function (User $user) {
            return $user->role->role == 'kepala_dinas';
        });

        Gate::define('sekda', function (User $user) {
            return $user->role->role == 'sekda';
        });

        Gate::define('walikota', function (User $user) {
            return $user->role->role == 'walikota';
        });

        Gate::define('staff_dokumentasi', function (User $user) {
            return $user->role->role == 'staff_dokumentasi';
        });

        Gate::define('kasubag_dokumentasi', function (User $user) {
            return $user->role->role == 'kasubag_dokumentasi';
        });
    }
}
