<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PostFeatureTest extends TestCase
{
    use RefreshDatabase;


    public function testCanCreatePost()
    {

        $data = [
            'name' => 'This is a test post',
            'description' => 'Description for a post'
        ];

        $this->actingAs(factory(User::class)->create());

        $this->post('posts', $data)
            ->assertStatus(302);


        $this->assertCount(1, Post::all());


    }
    
}
