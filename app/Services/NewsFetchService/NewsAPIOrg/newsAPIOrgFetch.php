<?php

namespace App\Services\NewsFetchService\NewsAPIOrg;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Model\FetchArticleOutput;

class newsAPIOrgFetch implements NewsSourceFetchInterface
{
    private array $categories = ["entertainment",
        "business",
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
        $result = [];
        foreach ($this->categories as $category) {
            $result[] = env('NEWS_SOURCE_NEWSAPIORG_URL') . "?apiKey=" . env("NEWS_SOURCE_NEWSAPIORG_API_KEY") .
                "&category=" . $category . "&sortBy=publishedAt";
        }
        return $result;
    }

    public function processResponse(string $content): array
    {
        $response = json_decode($content);
        $articles = $response->articles;
        $result = [];
        foreach ($articles as $article) {
            $result[] = new FetchArticleOutput(
                $article->title,
                $article->description ?? '',
                $article->url,
                $article->urlToImage ?? '',
                new \DateTime($article->publishedAt),
                $article->source->name ?? '',
                ''
            );
        }
        return $result;
    }
}
