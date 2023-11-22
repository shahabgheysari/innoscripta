<?php

namespace App\Services\NewsFetchService;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceSectionFetchInterface;
use App\Services\NewsFetchService\NewsAPIOrg\newsAPIOrgFetch;
use App\Services\NewsFetchService\NewsAPIOrg\NewsAPIOrgFetchSection;
use App\Services\NewsFetchService\NewYorkTimes\NewYorkTimesFetch;
use App\Services\NewsFetchService\NewYorkTimes\NewYorkTimesFetchSection;
use App\Services\NewsFetchService\TheGuardian\TheGuardianFetch;
use App\Services\NewsFetchService\TheGuardian\TheGuardianFetchSection;
use Illuminate\Contracts\Container\BindingResolutionException;

class NewsSourceAggregatorFactory
{
    /**
     * @return array| NewsSourceFetchInterface[]
     * @throws BindingResolutionException
     */
    public static function makeFetchServices(): array
    {
        return [
            app()->make(TheGuardianFetch::class),
            app()->make(NewYorkTimesFetch::class),
            app()->make(newsAPIOrgFetch::class)
        ];

    }

    /**
     * @return array|NewsSourceSectionFetchInterface[]
     * @throws BindingResolutionException
     */
    public static function makeFetchSectionServices(): array
    {
        return [
            app()->make(TheGuardianFetchSection::class),
            app()->make(NewsAPIOrgFetchSection::class),
            app()->make(NewYorkTimesFetchSection::class)
        ];
    }

}
