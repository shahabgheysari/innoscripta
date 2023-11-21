<?php

namespace App\Providers;

use App\Services\NewsFetchService\Concretes\NewsSourceFetchUrlAdapterGuzzle;
use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use App\Services\NewsFetchService\NewsAPIOrg\newsAPIOrgFetch;
use App\Services\NewsFetchService\NewsAPIOrg\NewsAPIOrgFetchUrlAdapter;
use App\Services\NewsFetchService\NewYorkTimes\NewYorkTimesFetch;
use App\Services\NewsFetchService\NewYorkTimes\NewYorkTimesFetchUrlAdapter;
use App\Services\NewsFetchService\TheGuardian\TheGuardianFetch;
use App\Services\NewsFetchService\TheGuardian\TheGuardianFetchUrlAdapter;
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

        $this->app->when(newsAPIOrgFetch::class)
            ->needs(NewsSourceFetchUrlAdapterInterface::class)
            ->give(function (){
                return new NewsAPIOrgFetchUrlAdapter();
            });

        $this->app->when(NewYorkTimesFetch::class)
            ->needs(NewsSourceFetchUrlAdapterInterface::class)
            ->give(function (){
                return new NewYorkTimesFetchUrlAdapter();
            });

        $this->app->when(TheGuardianFetch::class)
            ->needs(NewsSourceFetchUrlAdapterInterface::class)
            ->give(function (){
                return new TheGuardianFetchUrlAdapter();
            });

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
