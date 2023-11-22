<?php

namespace App\Services\NewsReadService\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface CriteriaFilter
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function filter(Builder $query): Builder;
}
