<?php

namespace App\Providers;

use App\ValueObjects\UserRole\UserRole;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 管理者のみ
        Gate::define(UserRole::ROLE_ONLY_ADMINISTRATOR, function ($user) {
            return ($user->role == UserRole::ADMINISTRATOR);
        });

        // 全ユーザ
        Gate::define(UserRole::ROLE_ALL_USER, function ($user) {
            return ($user->role >= UserRole::NORMAL);
        });
    }
}
