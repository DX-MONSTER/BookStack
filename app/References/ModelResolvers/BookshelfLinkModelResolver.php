<?php

namespace App\References\ModelResolvers;

use App\Entities\Models\Bookshelf;
use App\Model;

class BookshelfLinkModelResolver implements CrossLinkModelResolver
{
    public function resolve(string $link): ?Model
    {
        $pattern = '/^' . preg_quote(url('/shelves'), '/') . '\/([\w-]+)' . '([#?\/]|$)/';
        $matches = [];
        $match = preg_match($pattern, $link, $matches);
        if (!$match) {
            return null;
        }

        $shelfSlug = $matches[1];

        /** @var ?Bookshelf $model */
        $model = Bookshelf::query()->where('slug', '=', $shelfSlug)->first(['id']);

        return $model;
    }
}
