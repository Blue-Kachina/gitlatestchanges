<?php

namespace bluekachina\gitlatestchanges;

use Illuminate\Support\ServiceProvider;

class GitLatestChangesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->make('bluekachina\gitlatestchanges\GitLatestChanges.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \bluekachina\gitlatestchanges\commands\GitLatestChanges::class
            ]);
        }


//        $this->loadRoutesFrom(__DIR__.'/routes.php');
//        $this->loadMigrationsFrom(__DIR__.'/migrations');
//        $this->loadViewsFrom(__DIR__.'/views', 'gitlatestchanges');
        $this->publishes([
            __DIR__.'/../src/config/gitlatestchanges.php' => config_path('gitlatestchanges.php'),
        ]);
    }
}
