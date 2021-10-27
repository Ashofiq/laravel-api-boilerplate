<?php 
namespace App\Repositories\User;


use Illuminate\Support\ServiceProvider;

class UserRepoServiceProvide extends ServiceProvider
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
        $this->app->bind('App\Repositories\User\UserInterface', 'App\Repositories\User\UserRepository');
    }
}