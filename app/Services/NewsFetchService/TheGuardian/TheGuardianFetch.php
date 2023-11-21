<?php

namespace App\Services\NewsFetchService\TheGuardian;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceInfoInterface;
use App\Services\NewsFetchService\Model\FetchArticleOutput;
use Guardian\GuardianAPI;

class TheGuardianFetch implements NewsSourceFetchInterface, NewsSourceInfoInterface
{
    use InfoTrait;

    private const pageSizeLimit = 200;

    public function makeFetchUrls(): array
    {
        $result = [];
        $guardian = new GuardianAPI(env('NEWS_SOURCE_THEGUARDIAN_API_KEY'));
        $firstFetch = $guardian->content()
            ->setFromDate(new \DateTimeImmutable())
            ->setOrderBy('newest')
            ->fetch();
        $total = $firstFetch->response->total;
        $pages = ($total / self::pageSizeLimit) + ($total / self::pageSizeLimit != 0 ? 1 : 0);
        for ($pageNumber = 1; $pageNumber <= $pages; $pageNumber++) {
            $result[] = env('NEWS_SOURCE_THEGUARDIAN_URL') . "?api-key=" . env('NEWS_SOURCE_THEGUARDIAN_API_KEY') .
                "&from-date=" . (new \DateTime())->format('Y-m-d') . "&page=" . $pageNumber . "&page-size=" . self::pageSizeLimit;
        }

        return $result;
    }

    public function processResponse(string $content): array
    {
        $response = json_decode($content);
        $articles = $response->response->results;
        $result = [];
        foreach ($articles as $article) {
            $result[] = new FetchArticleOutput(
                $article->webTitle,
                '',
                $article->webUrl,
                '',
                new \DateTime($article->webPublicationDate),
                'TheGuardian',
                $article->sectionName
            );
        }
        return $result;
    }
}
