<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Hash;
use Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

class PosTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_post_is_stored()
    {

        $data = [
            'user_id' => 1,
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => "image.jpg",

        ];

        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'email_verified_at' => now(),
            'password' => $this->faker->password(), // password
            'remember_token' => Str::random(10),
        ]);

        $this->actingAs($user)
            ->post(route('post.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('post'));        
    }
}