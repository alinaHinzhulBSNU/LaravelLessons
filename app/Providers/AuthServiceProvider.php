<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Author' => 'App\Policies\BookAuthorsPolicy',
        'App\Book' => 'App\Policies\BooksPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user){
            if($user->email == 'admin@example.com'){
                $user->role = 'admin';
                $user->save();
            }

            // Для першого запуску
            return $user->role == 'admin';
        });
    }
}
