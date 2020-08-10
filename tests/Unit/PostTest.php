<?php

namespace Tests\Unit;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test
     */
    public function post_is_created()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->postJson('/post/store', [
            'name' => 'Test',
            'description' => 'This a Description for a test in this application',
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at ' => null
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'Test',
            'description' => 'This a Description for a test in this application',
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null
        ]);
    }

    /** @test */
    public function fields_are_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('/post/store')
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'description'
            ]);
    }
}
