<?php

namespace Database\Seeders;

use App\Models\KeywordsPool;
use App\Models\LogPublications;
use App\Models\TopicsSuggestion;
use App\Models\News;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a set of Keywords
        KeywordsPool::factory(10)->create();

        // Create a set of Topics Suggestions
        TopicsSuggestion::factory(20)->create();

        // Create a set of News
        News::factory(10)->create();

        // Create a set of Log Publications
        LogPublications::factory(5)->create();
    }
}
