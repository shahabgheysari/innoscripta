<?php

namespace App\Services\NewsFetchService\Contracts;

interface NewsSourceFetchUrlAdapterInterface
{
    public function fetchFromUrl(string $url): ?string;
}
