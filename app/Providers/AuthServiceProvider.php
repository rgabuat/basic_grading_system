<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\SemesterPolicy;
use App\Policies\GradingPeriodPolicy;
use App\Policies\YearLevelPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\GradingPeriod;
use App\Models\Semesters;
use App\Models\Year_levels;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Semesters::class => SemesterPolicy::class,
        GradingPeriod::class => GradingPeriodPolicy::class,
        Year_levels::class => YearLevelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}
