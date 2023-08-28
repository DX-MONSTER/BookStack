<?php

namespace App\Entities\Tools;

use App\Entities\EntityProvider;
use App\Entities\Models\Book;
use App\Entities\Models\Bookshelf;
use App\Entities\Models\Chapter;
use App\Entities\Models\Page;
use Illuminate\Support\Collection;

class SiblingFetcher
{
    /**
     * Search among the siblings of the entity of given type and id.
     */
    public function fetch(string $entityType, int $entityId): Collection
    {
        $entity = (new EntityProvider())->get($entityType)->visible()->findOrFail($entityId);
        $entities = [];

        // Page in chapter
        if ($entity instanceof Page && $entity->chapter) {
            $entities = $entity->chapter->getVisiblePages();
        }

        // Page in book or chapter
        if (($entity instanceof Page && !$entity->chapter) || $entity instanceof Chapter) {
            $entities = $entity->book->getDirectChildren();
        }

        // Book
        // Gets just the books in a shelf if shelf is in context
        if ($entity instanceof Book) {
            $contextShelf = (new ShelfContext())->getContextualShelfForBook($entity);
            if ($contextShelf) {
                $entities = $contextShelf->visibleBooks()->get();
            } else {
                $entities = Book::visible()->get();
            }
        }

        // Shelf
        if ($entity instanceof Bookshelf) {
            $entities = Bookshelf::visible()->get();
        }

        return $entities;
    }
}
