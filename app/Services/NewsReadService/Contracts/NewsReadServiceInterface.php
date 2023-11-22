<?php

namespace App\Services\NewsReadService\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface NewsReadServiceInterface
{
    public function getFilterMaps(): array;

    public function paginateWithFilter($limit = 10, $offset = 1, array $filters = []);
}
