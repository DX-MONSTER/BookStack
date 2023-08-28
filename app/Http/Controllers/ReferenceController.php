<?php

namespace App\Http\Controllers;

use App\Entities\Models\Book;
use App\Entities\Models\Bookshelf;
use App\Entities\Models\Chapter;
use App\Entities\Models\Page;
use App\References\ReferenceFetcher;

class ReferenceController extends Controller
{
    protected ReferenceFetcher $referenceFetcher;

    public function __construct(ReferenceFetcher $referenceFetcher)
    {
        $this->referenceFetcher = $referenceFetcher;
    }

    /**
     * Display the references to a given page.
     */
    public function page(string $bookSlug, string $pageSlug)
    {
        $page = Page::getBySlugs($bookSlug, $pageSlug);
        $references = $this->referenceFetcher->getPageReferencesToEntity($page);

        return view('pages.references', [
            'page'       => $page,
            'references' => $references,
        ]);
    }

    /**
     * Display the references to a given chapter.
     */
    public function chapter(string $bookSlug, string $chapterSlug)
    {
        $chapter = Chapter::getBySlugs($bookSlug, $chapterSlug);
        $references = $this->referenceFetcher->getPageReferencesToEntity($chapter);

        return view('chapters.references', [
            'chapter'    => $chapter,
            'references' => $references,
        ]);
    }

    /**
     * Display the references to a given book.
     */
    public function book(string $slug)
    {
        $book = Book::getBySlug($slug);
        $references = $this->referenceFetcher->getPageReferencesToEntity($book);

        return view('books.references', [
            'book'       => $book,
            'references' => $references,
        ]);
    }

    /**
     * Display the references to a given shelf.
     */
    public function shelf(string $slug)
    {
        $shelf = Bookshelf::getBySlug($slug);
        $references = $this->referenceFetcher->getPageReferencesToEntity($shelf);

        return view('shelves.references', [
            'shelf'      => $shelf,
            'references' => $references,
        ]);
    }
}
