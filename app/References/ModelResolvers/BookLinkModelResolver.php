<?php

namespace App\References\ModelResolvers;

use App\Entities\Models\Book;
use App\Model;

class BookLinkModelResolver implements CrossLinkModelResolver
{
    public function resolve(string $link): ?Model
    {
        $pattern = '/^' . preg_quote(url('/books'), '/') . '\/([\w-]+)' . '([#?\/]|$)/';
        $matches = [];
        $match = preg_match($pattern, $link, $matches);
        if (!$match) {
            return null;
        }

        $bookSlug = $matches[1];

        /** @var ?Book $model */
        $model = Book::query()->where('slug', '=', $bookSlug)->first(['id']);

        return $model;
    }
}
