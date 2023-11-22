<?php

namespace App\Services\NewsFetchService\NewYorkTimes;

use App\Services\NewsFetchService\Contracts\NewsSourceSectionFetchInterface;
use App\Services\NewsFetchService\Model\FetchSectionsOutput;

class NewYorkTimesFetchSection implements NewsSourceSectionFetchInterface
{

    /**
     * @inheritDoc
     */
    public function makeFetchUrls(): array
    {
        return [env('NEWS_SOURCE_NYT_SECTIONS_URL') . "?api-key=" . env('NEWS_SOURCE_NYT_API_KEY')];
    }

    /**
     * @inheritDoc
     */
    public function processResponse(string $content): array
    {
        $response = json_decode($content);
        $sections = $response->results;
        $result = [];
        foreach ($sections as $section) {
            $result[] = new FetchSectionsOutput(
                $section->section,
                $section->display_name
            );
        }
        return $result;
    }
}
