<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; //追加

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Slack\SlackRepositoryInterface',
            'App\Repositories\Slack\SlackRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 以下を追記
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
        
        Schema::defaultStringLength(191); //追記
    }
}
