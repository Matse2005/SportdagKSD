<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()

    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = cache()->remember(
            'settings',
            3600,
            fn () => Setting::all()->keyBy('key')
        );
        view()->share('settings', $settings);


        if (!Role::where('name', 'admin')->first()) {
            $admin = Role::create(['name' => 'admin']);
            $permission = Permission::create(['name' => 'view dashboard']);
            $admin->givePermissionTo('view dashboard');
        }

        if ($user = User::where('id', 1)->first()) {
            if (!$user->hasRole('admin')) {
                $user->assignRole('admin');
            }
        }
    }
}
