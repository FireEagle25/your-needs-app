<?php

namespace App\Filters\ModelFilters;

use App\Filters\ModelFilters\Contracts\AbstractFilter;
use App\Filters\PropertiesFilters\AuthorWhereInFilter;

class BookFilter extends AbstractFilter
{
    /**
     * {@inheritdoc}
     */
    protected array $filters = [
        'author' => AuthorWhereInFilter::class,
    ];
}
