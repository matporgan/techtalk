<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        
        $gate->before(function ($user, $ability) {
            if ($user->isSuperAdmin()) 
            {
                return true;
            }
        });

        $gate->define('update-org', function ($user, $org) {
            foreach ($user->orgs as $user_org)
            {
                if ($user->isAdmin()) 
                {
                    return true;
                }
                elseif ($user_org->pivot->org_id == $org->id) 
                {
                    return true;
                }
            }
        });

        $gate->define('update-comment', function ($user, $comment) {
            foreach ($user->comments as $user_comment)
            {
                if ($user_comment->id == $comment->id) 
                {
                    return true;
                }
            }
        });
    }
}
