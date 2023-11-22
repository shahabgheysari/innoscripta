<?php

namespace App\Services\NewsReadService\Filters;

use App\Services\NewsReadService\Concretes\EloquentFilter;
use App\Services\NewsReadService\Contracts\CriteriaFilter;

class DateFrom extends EloquentFilter implements CriteriaFilter
{
    public function __construct(string $value, string $field="published_at", string $operator = '>=')
    {
        parent::__construct($value, $field, $operator);
    }


}
