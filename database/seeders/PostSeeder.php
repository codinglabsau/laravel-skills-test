<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory()->create([
            'user_id' => 1,
            'name' => 'Post Title',
            'description' => 'some description',
        ]);
    }
}
