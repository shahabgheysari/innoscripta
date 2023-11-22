<?php

namespace App\Services\NewsFetchService\TheGuardian;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceSectionFetchInterface;
use App\Services\NewsFetchService\Model\FetchSectionsOutput;

class TheGuardianFetchSection implements NewsSourceSectionFetchInterface
{
    /**
     * @inheritDoc
     */
    public function makeFetchUrls(): array
    {
        return [env('NEWS_SOURCE_THEGUARDIAN_SECTIONS_URL') . "?api-key=" . env('NEWS_SOURCE_THEGUARDIAN_API_KEY')];
    }

    /**
     * @inheritDoc
     */
    public function processResponse(string $content): array
    {
        $response = json_decode($content);
        $sections = $response->response->results;
        $result = [];
        foreach ($sections as $section) {
            $result[] = new FetchSectionsOutput($section->id, $section->webTitle);
        }
        return $result;
    }
}
