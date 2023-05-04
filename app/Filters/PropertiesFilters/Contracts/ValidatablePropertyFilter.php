<?php

namespace App\Filters\PropertiesFilters\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class ValidatablePropertyFilter implements PropertyFilter
{
    protected array $rules = [];

    public function filter(Builder $builder, mixed $value): Builder
    {
        if (empty($value) || ! $this->validate($value)) {
            return $builder;
        }

        return $this->apply($builder, $value);
    }

    private function validate(mixed $value): bool
    {
        return validator($value, $this->rules)->passes();
    }

    abstract protected function apply(Builder $builder, mixed $value): Builder;
}
