<?php

namespace App\Filters\PropertiesFilters;

use App\Filters\PropertiesFilters\Contracts\PropertyFilter;
use App\Filters\PropertiesFilters\Contracts\ValidatablePropertyFilter;
use Illuminate\Database\Eloquent\Builder;

class AuthorWhereInFilter extends ValidatablePropertyFilter
{
    protected array $rules = [
        'array' => ['array_int']
    ];


    protected function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereIn('author_id', $value);
    }
}
