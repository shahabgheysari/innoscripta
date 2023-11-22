<?php

namespace App\Services\NewsFetchService;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use App\Services\NewsFetchService\Model\FetchSectionsOutput;
use Illuminate\Support\Facades\DB;

class NewsSourceSectionsPersistService
{

    public function __construct(private NewsSourceFetchUrlAdapterInterface $fetchUrlAdapter)
    {
    }

    /**
     * @return int the number of sections that was inserted
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function fetchAndPersist(): int
    {
        $count = 0;
        $services = NewsSourceAggregatorFactory::makeFetchSectionServices();
        foreach ($services as $service) {
            $urls = $service->makeFetchUrls();
            foreach ($urls as $url) {
                $content = $this->fetchUrlAdapter->fetchFromUrl($url);
                if (is_null($content)) continue;
                $result = $service->processResponse($content);
                if (count($result)) {
                    $count+= count($result);
                    $this->saveSections($result);
                }
            }
        }
        return $count;
    }

    /**
     * @param array|FetchSectionsOutput[] $sections
     * @return void
     */
    private function saveSections(array $sections): void
    {
        $data = [];
        foreach ($sections as $section) {
            $data[] = [
                'external_id' => $section->getExternalId(),
                'title' => $section->getTitle()
            ];
        }

        DB::table('article_categories')->upsert($data,['title']);
    }

}
