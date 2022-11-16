<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\PostSeeder;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use HasFactory;

    public function test_post_can_be_created()
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(PostSeeder::class);
        $this->assertEquals(1, Post::count());
    }
}
