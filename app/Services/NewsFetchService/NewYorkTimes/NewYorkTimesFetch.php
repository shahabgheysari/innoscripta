<?php

namespace App\Services\NewsFetchService\NewYorkTimes;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceInfoInterface;
use App\Services\NewsFetchService\Model\FetchArticleOutput;

class NewYorkTimesFetch implements NewsSourceFetchInterface, NewsSourceInfoInterface
{
    use InfoTrait;

    /**
     * @inheritDoc
     */
    public function makeFetchUrls(): array
    {
        return [env('NEWS_SOURCE_NYT_URL') . "?api-key=" . env('NEWS_SOURCE_NYT_API_KEY')];
    }

    public function processResponse(string $content): array
    {
        $response = json_decode($content);
        $articles = $response->results;
        $result = [];
        foreach ($articles as $article) {
            $result[] = new FetchArticleOutput(
                $article->title,
                $article->abstract,
                $article->url,
                $article->multimedia[0]->url,
                new \DateTime($article->webPublicationDate),
                'NewYorkTimes',
                $article->section
            );
        }
        return $result;
    }
}
