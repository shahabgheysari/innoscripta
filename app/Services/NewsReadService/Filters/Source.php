<?php

namespace App\Services\NewsReadService\Filters;

use App\Services\NewsReadService\Concretes\EloquentFilter;
use App\Services\NewsReadService\Contracts\CriteriaFilter;
use Illuminate\Database\Eloquent\Builder;

class Source extends EloquentFilter implements CriteriaFilter
{
    public function __construct(string $value, string $field='name', string $operator = 'like')
    {
        parent::__construct($value, $field, $operator);
    }

    public function filter(Builder $query): Builder
    {
         return $query->leftJoin('sources','articles.source_id','=','sources.id')->where('sources.name','ilike',$this->value);
    }


}
