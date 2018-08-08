<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $fillable = [
      'id', 'name', 'email', 'password',
    ];
    public function testExample()
    {
      // prepare the dummy data
      $data = [
        'name' => 'Jefferson Babuyo',
        'description' => 'This is a unit test.'
      ];

      // define the user
      $user = new User([
          'id' => 143,
          'name' => 'Jefferson Babuyo',
          'email' => 'jeff@test.com',
          'password' => 'secret'
      ]);


    }
}
