<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Word;
use App\Models\Comment;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(99)->create();
        Word::factory(100)->create();
        Comment::factory(100)->create();
        Message::factory(5)->create();
        Post::factory(20)->create();
    }
}
