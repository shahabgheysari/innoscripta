<?php

namespace App\Providers;

use App\Services\NewsFetchService\Concretes\NewsSourceFetchUrlAdapterGuzzle;
use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(NewsSourceFetchUrlAdapterInterface::class,function (){
            return $this->app->make(NewsSourceFetchUrlAdapterGuzzle::class);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
