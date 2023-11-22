<?php

namespace App\Services\NewsFetchService\NewsAPIOrg;

use App\Services\NewsFetchService\Contracts\NewsSourceSectionFetchInterface;
use App\Services\NewsFetchService\Model\FetchSectionsOutput;

class NewsAPIOrgFetchSection implements NewsSourceSectionFetchInterface
{

    const SECTIONS = [
        "business",
        "entertainment",
        "general",
        "health",
        "science",
        "sports",
        "technology"];

    /**
     * @inheritDoc
     */
    public function makeFetchUrls(): array
    {
        return ['https://newsapi.org/'];
    }

    /**
     * @inheritDoc
     */
    public function processResponse(string $content): array
    {
        $result = [];
        foreach (self::SECTIONS as $section) {
            $result[] = new FetchSectionsOutput($section, $section);
        }
        return $result;
    }
}
