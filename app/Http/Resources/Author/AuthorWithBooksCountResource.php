<?php

namespace App\Http\Resources\Author;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @property ?int $books_count
 */
class AuthorWithBooksCountResource extends AuthorResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $author = parent::toArray($request);

        if ($this->books_count) {
            $author['books_count'] = $this->books_count;
        }

        return $author;
    }
}
