<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Policies\LeadPolicy;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\LeadComment\Policies\LeadCommentPolicy;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Policies\RolePolicy;
use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\TaskComment\Policies\TaskCommentPolicy;
use App\Modules\Admin\Users\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Source::class => Source::class,
        Lead::class => LeadPolicy::class,
        LeadComment::class => LeadCommentPolicy::class,
        Task::class => TaskCommentPolicy::class,
        TaskComment::class => TaskCommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
