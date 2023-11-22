<?php

namespace App\Services\NewsReadService\Filters;


use App\Services\NewsReadService\Concretes\EloquentFilter;
use App\Services\NewsReadService\Contracts\CriteriaFilter;
use Illuminate\Database\Eloquent\Builder;

class Category extends EloquentFilter implements CriteriaFilter
{
    public function __construct(string $value, string $field='title', string $operator = '=')
    {
        parent::__construct($value, $field, $operator);
    }

    public function filter(Builder $query): Builder
    {
         return $query->leftJoin('article_categories','articles.article_category_id','=','article_categories.id')->where('article_categories.title','ilike',$this->value);
    }

}
