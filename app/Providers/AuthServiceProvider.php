<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Box;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('box-asing', function(User $user){
            
            return auth()->user()->boxes()->where('status',1)->exists();
        });
        Gate::define('box-exist', function(User $user){
            return !auth()->user()->boxes()->where('status',1)->exists();
        });
        //
    }
}
