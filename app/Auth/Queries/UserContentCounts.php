<?php

namespace App\Auth\Queries;

use App\Auth\User;
use App\Entities\Models\Book;
use App\Entities\Models\Bookshelf;
use App\Entities\Models\Chapter;
use App\Entities\Models\Page;

/**
 * Get asset created counts for the given user.
 */
class UserContentCounts
{
    /**
     * @return array{pages: int, chapters: int, books: int, shelves: int}
     */
    public function run(User $user): array
    {
        $createdBy = ['created_by' => $user->id];

        return [
            'pages'    => Page::visible()->where($createdBy)->count(),
            'chapters' => Chapter::visible()->where($createdBy)->count(),
            'books'    => Book::visible()->where($createdBy)->count(),
            'shelves'  => Bookshelf::visible()->where($createdBy)->count(),
        ];
    }
}
