<?php

namespace App\Filters\PropertiesFilters\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface PropertyFilter
{
    /**
     * @return mixed
     */
    public function filter(Builder $builder, mixed $value): Builder;
}
