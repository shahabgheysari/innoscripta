<?php

namespace App\Services\NewsFetchService;

use App\Constants\CacheKeys;
use App\Models\ArticleCategories;
use App\Models\Sources;
use App\Services\NewsFetchService\Model\FetchArticleOutput;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PersistArticleService
{
    /**
     * @param array|FetchArticleOutput[] $articles
     * @return void
     */
    public function persist(array $articles): void
    {
        $sources = Cache::get('article_sources', function () {
            return Sources::all();
        });

        $data = [];
        foreach ($articles as $article) {
            $data[] = [
                'title' => $article->getTitle(),
                'summary' => $article->getSummary(),
                'url' => $article->getUrl(),
                'image_url' => $article->getImageUrl(),
                'published_at' => $article->getPublishedAt(),
                'source_id' => $this->getSourceId($article->getSource()),
                'article_category_id' => $this->getCategoryId($article->getCategory()),
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime(),
            ];
        }
        DB::table('articles')->insert($data);
    }

    private function getSourceId(string $name): int
    {
        /** @var Collection $sources */
        $sources = Cache::remember(CacheKeys::ARTICLE_SOURCE_KEY->value, 300, function () {
            return Sources::all();
        });
        $source = $sources->filter(function ($item) use ($name) {
            return $item->name == $name;
        })->first();
        if (empty($source)) {
            $source = new Sources();
            $source->name = $name;
            $source->save();
            Cache::delete(CacheKeys::ARTICLE_SOURCE_KEY->value);
        }
        return $source->id;
    }

    private function getCategoryId(string $title): int
    {
        if (empty($title)) {
            $title = 'general';
        }
        /** @var Collection $categories */
        $categories = Cache::remember(CacheKeys::ARTICLE_CATEGORY_KEY->value, 300, function () {
            return ArticleCategories::all();
        });
        $category = $categories->filter(function ($item) use ($title) {
            return $item->title == $title;
        })->first();
        if (empty($category)) {
            $category = new ArticleCategories();
            $category->title = $title;
            $category->save();
            Cache::delete(CacheKeys::ARTICLE_CATEGORY_KEY->value);
        }
        return $category->id;
    }
}
