<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsListRequest;
use App\Services\NewsReadService\Contracts\NewsReadServiceInterface;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function __construct(private NewsReadServiceInterface $readService)
    {
    }

    public function index(NewsListRequest $request)
    {
        $pagination = [
            "page" => $request->query('page', 1),
            "per_page" => $request->query('per_page', config('news.pagination.per_page')),
        ];

        $filters = [];
        foreach($request->all() as $name => $val) {
            $result = array_filter(array_keys($this->readService->getFilterMaps()),function ($value) use ($name){
                return Str::startsWith($value,$name);
            });
            if(count($result)) {
                $filters [$name] = $val;
            }
        }
        return $this->readService->paginateWithFilter($pagination['per_page'], $pagination['page'], $filters);

    }
}
