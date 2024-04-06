<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Pagination\Paginator;
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

    // protected $policies = [
    //     Idea::class => IdeaPermissions::class
    // ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        //

        //app() -> setLocale('am_ET');

        // Role based Auth
        Gate::define('isAdmin', function(User $user): bool {
            return $user -> is_admin;
        });

        // Permission based Auth
        Gate::define('idea.delete', function(User $user, Idea $idea): bool {
            return $user -> is_admin || $user -> id == $idea -> user_id;
        });

        Gate::define('idea.edit', function(User $user, Idea $idea): bool {
            return $user -> is_admin || $user -> id == $idea -> user_id;
        });
    }
}
