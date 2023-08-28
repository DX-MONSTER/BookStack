<?php

namespace Database\Seeders;

use App\Auth\Permissions\JointPermissionBuilder;
use App\Auth\Role;
use App\Auth\User;
use App\Entities\Models\Book;
use App\Entities\Models\Chapter;
use App\Entities\Models\Page;
use App\Search\SearchIndex;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LargeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an editor user
        $editorUser = User::factory()->create();
        $editorRole = Role::getRole('editor');
        $editorUser->attachRole($editorRole);

        /** @var Book $largeBook */
        $largeBook = Book::factory()->create(['name' => 'Large book' . Str::random(10), 'created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
        $pages = Page::factory()->count(200)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);
        $chapters = Chapter::factory()->count(50)->make(['created_by' => $editorUser->id, 'updated_by' => $editorUser->id]);

        $largeBook->pages()->saveMany($pages);
        $largeBook->chapters()->saveMany($chapters);
        $all = array_merge([$largeBook], array_values($pages->all()), array_values($chapters->all()));

        app()->make(JointPermissionBuilder::class)->rebuildForEntity($largeBook);
        app()->make(SearchIndex::class)->indexEntities($all);
    }
}
