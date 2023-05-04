<?php

namespace App\Filters\ModelFilters\Contracts;

use App\Filters\PropertiesFilters\Contracts\PropertyFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter
{
    /**
     * @var array<string, string>
     */
    protected array $filters = [];

    protected array $filtersData = [];

    public function __construct(array $filtersData = [])
    {
        $this->filtersData = $filtersData;
    }

    public static function createWithRequest(Request $request): static
    {
        $filtersData = $request->all();

        return new static($filtersData);
    }

    /**
     * @param  array<mixed>  $filtersData
     */
    public static function createWithArray(array $filtersData): static
    {
        return new static($filtersData);
    }

    public function filter(Builder $builder): Builder
    {
        foreach ($this->filtersData as $filter => $value) {
            $filter = $this->resolveFilter($filter);

            if ($filter) {
                $builder = $filter->filter($builder, $value);
            }
        }

        return $builder;
    }

    /**
     * @return ?PropertyFilter
     */
    protected function resolveFilter(string $fieldName): ?PropertyFilter
    {
        if (isset($this->filters[$fieldName])) {
            return new $this->filters[$fieldName];
        }

        return null;
    }
}
