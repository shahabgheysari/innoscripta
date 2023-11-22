<?php

namespace App\Services\NewsReadService\Filters;

use App\Services\NewsReadService\Concretes\EloquentFilter;
use App\Services\NewsReadService\Contracts\CriteriaFilter;
use Illuminate\Database\Eloquent\Builder;

class DateTo extends EloquentFilter implements CriteriaFilter
{
    public function __construct(string $value, string $field = "published_at", string $operator = '<=')
    {
        parent::__construct($value, $field, $operator);
    }

    public function filter(Builder $query): Builder
    {
        return $query->where($this->field,$this->operator,$this->value.' 23:59:59');
    }


}
