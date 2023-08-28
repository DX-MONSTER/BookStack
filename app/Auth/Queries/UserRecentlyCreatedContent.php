<?php

namespace App\Auth\Queries;

use App\Auth\User;
use App\Entities\Models\Book;
use App\Entities\Models\Bookshelf;
use App\Entities\Models\Chapter;
use App\Entities\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get the recently created content for the provided user.
 */
class UserRecentlyCreatedContent
{
    /**
     * @return array{pages: Collection, chapters: Collection, books: Collection, shelves: Collection}
     */
    public function run(User $user, int $count): array
    {
        $query = function (Builder $query) use ($user, $count) {
            return $query->orderBy('created_at', 'desc')
                ->where('created_by', '=', $user->id)
                ->take($count)
                ->get();
        };

        return [
            'pages'    => $query(Page::visible()->where('draft', '=', false)),
            'chapters' => $query(Chapter::visible()),
            'books'    => $query(Book::visible()),
            'shelves'  => $query(Bookshelf::visible()),
        ];
    }
}
