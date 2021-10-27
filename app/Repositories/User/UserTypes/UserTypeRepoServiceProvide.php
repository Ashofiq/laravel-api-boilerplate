<?php 

namespace App\Repositories\User\UserTypes;

use Illuminate\Support\ServiceProvider;

class UserTypeRepoServiceProvide extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\User\UserTypes\UserTypeInterface', 'App\Repositories\User\UserTypes\UserTypeRepository');
    }
}