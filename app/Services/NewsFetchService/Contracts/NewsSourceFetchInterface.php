<?php

namespace App\Services\NewsFetchService\Contracts;

use App\Services\NewsFetchService\Model\FetchArticleOutput;

interface NewsSourceFetchInterface
{
    /**
     * @return FetchArticleOutput[]
     */
     public function makeFetchUrls(): array;

    /**
     * @param mixed $content
     * @return array|FetchArticleOutput[]
     */
    public function processResponse(string $content): array;
}
