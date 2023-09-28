<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Suggestion;
use App\Models\SuggestionVote;
use App\Policies\VotePolicy;
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
        SuggestionVote::class => VotePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('vote','App\Policies\VotePolicy@vote');
    }
}
