<?php

namespace App\Services\NewsFetchService;

use App\Jobs\ProcessArticleFetch;

class NewsAggregatorFetchService
{
    public function fetch(): void
    {
        foreach (NewsSourceAggregatorFactory::makeFetchServices() as $fetchService) {
            $urls = $fetchService->makeFetchUrls();
            foreach ($urls as $url) {
                ProcessArticleFetch::dispatch($url, $fetchService);
            }

        }
    }

}
