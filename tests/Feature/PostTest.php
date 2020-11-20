<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test()
    {
        //Create simple post
        $post = new Post();
        $post->user_id = 1;
        $post->name = "Test post";
        $post->description = "Test description";
        $post->save();
        $this->assertDatabaseHas('posts', ['user_id' => 1, 'name' => 'Test post', 'description' => 'Test description']); //Manually wrote out array to be sure.

        //Delete post
        $post->delete();
        $this->assertDeleted('posts', $post->toArray());
    }

    public function testPostWithImage()
    {
        //Create post object
        $post = new Post();
        $post->user_id = 1;
        $post->name = "Test post with image";
        $post->description = "Test description";

        //Generate UUID for image and filename
        $uuid = Str::uuid();
        $filename = $uuid.'.jpg';

        //Create 400x300px image with red background
        $image = Image::canvas(400, 300, '#ff0000');

        //Compose paths
        $relativePath = 'public/post-images/'.$filename; //Relative to '[project-root]/storage/app'
        $path = Storage::path($relativePath);

        //Save image and ensure it has been written
        $image->save($path);
        Storage::assertExists($relativePath);

        //Save the post and ensure it exists in the db
        $post->save();
        $this->assertDatabaseHas('posts', $post->toArray());

        //Delete image from storage and ensure it has been deleted
        Storage::delete($relativePath);
        Storage::assertMissing($relativePath);

        //Delete post and ensure it no longer exists
        $post->delete();
        $this->assertDeleted('posts', $post->toArray());
    }

}
