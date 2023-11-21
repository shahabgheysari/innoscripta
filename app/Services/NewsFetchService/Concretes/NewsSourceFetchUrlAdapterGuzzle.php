<?php

namespace App\Services\NewsFetchService\Concretes;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class NewsSourceFetchUrlAdapterGuzzle implements NewsSourceFetchUrlAdapterInterface
{
    public function __construct(private Client $client, private LoggerInterface $logger)
    {
    }

    public function fetchFromUrl(string $url): ?string
    {
        try {
            return $this->client->get($url)->getBody()->getContents();
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage(), ['context' => $exception]);
        }
        return null;
    }
}
