<?php

namespace App\Services\NewsFetchService\Contracts;

use App\Services\NewsFetchService\Model\FetchSectionsOutput;

interface NewsSourceSectionFetchInterface
{
    /**
     * @return string[]
     */
    public function makeFetchUrls(): array;

    /**
     * @param mixed $content
     * @return array|FetchSectionsOutput[]
     */
    public function processResponse(string $content): array;

}
