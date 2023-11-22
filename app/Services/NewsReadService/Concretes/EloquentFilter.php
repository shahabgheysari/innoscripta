<?php

namespace App\Services\NewsReadService\Concretes;

use App\Services\NewsReadService\Contracts\CriteriaFilter;
use Illuminate\Database\Eloquent\Builder;

class EloquentFilter implements CriteriaFilter
{
    public function __construct(
        protected string $value,
        protected string $field,
        protected string $operator = '='
    )
    {
    }

    public function filter( Builder $query): Builder
    {
        return $query->where($this->field,$this->operator,$this->value);
    }
}
