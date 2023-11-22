<?php

namespace App\Services\NewsReadService;

use App\Models\Articles;
use App\Services\NewsReadService\Contracts\NewsReadServiceInterface;
use App\Services\NewsReadService\Filters\Category;
use App\Services\NewsReadService\Filters\DateFrom;
use App\Services\NewsReadService\Filters\DateTo;
use App\Services\NewsReadService\Filters\Source;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class NewsReadService implements NewsReadServiceInterface
{
    public function getFilterMaps(): array
    {
        return [
            "category" => Category::class,
            "date_from" => DateFrom::class,
            "date_to" => DateTo::class,
            "source" => Source::class,
        ];
    }

    public function paginateWithFilter($limit = 10, $offset = 1, array $filters = [],$columns = ['*']): LengthAwarePaginator
    {
        $query = Articles::query();
        $criteria = $this->extractFilters($filters);
        $criteria->each(function ($criterion) use ($query){
            $criterion->filter($query);
        });
        $query->orderBy('published_at','desc');
        return $query->paginate($limit,$columns,'page',$offset)->appends($filters);
    }

    protected function extractFilters(array $filters): \Illuminate\Support\Collection
    {
        $filterMaps = $this->getFilterMaps();
        $filterRegex = '/('.implode('|', array_keys($filterMaps)).')/m';
        $criteria = new \Illuminate\Support\Collection();
        foreach($filters as $requestVar => $val) {
            if(!Str::startsWith($requestVar, array_keys($filterMaps))) {
                continue;
            }

            preg_match_all($filterRegex, $requestVar, $matches);
            $filterMatches = $matches[0];

            $filterObject = new $filterMaps[$filterMatches[0]]($val);

            $criteria->push($filterObject);
        }

        return $criteria;
    }
}
