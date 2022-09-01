<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class ExampleTest extends TestCase{

    use RefreshDatabase;

    //Landing Page
    public function test_landing_page_returns_a_successful_response(){

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    //Posts
    public function test_create_new_post(){

        $user = $this->user_registered_after_email_verification();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->post(route('posts.store'), [
            'name' => 'a cool name',
            'description' => 'a cool description'
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'a cool name',
            'description' => 'a cool description'
        ]);
    }

    public function test_update_post(){

        $user = $this->user_registered_after_email_verification();
        
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        //Create post
        $response = $this->post(route('posts.store'), [
            'name' => 'good name',
            'description' => 'good description'
        ]);
        $this->assertDatabaseHas('posts', [
            'name' => 'good name',
            'description' => 'good description'
        ]);

        //Go to edit page
        $response = $this->actingAs($user)->get('/dashboard/posts/1/edit');
        $response->assertStatus(200);

        //Update post
        $response = $this->put(route('posts.update',['post' => 1]), [
            'name' => 'bad name',
            'description' => 'bad description'
        ]);
        $this->assertDatabaseHas('posts', [
            'name' => 'bad name',
            'description' => 'bad description'
        ]);
    }

    //Login/Registrations
    public function test_new_email_registered_user_cannot_access_dashboard_before_email_verification(){

        $user = $this->user_registered_before_email_verification();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/verify-email');
    }

    public function test_new_email_registered_user_can_access_dashboard_after_email_verification(){

        $user = $this->user_registered_after_email_verification();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Create a new Post');
    }

    public function test_user_registered_with_google_can_access_dashboard(){

        $user = $this->user_registered_with_google();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Create a new Post');
    }

    public function test_user_registered_with_google_first_cant_login_with_email(){
      
        $user = $this->user_registered_with_google();
        
        $response = $this->post('/login', [
            'email' => 'mark@codinglabs.com.au',
            'password' => 'dont know password'
        ]);
        $response->assertRedirect('/'); 
        $response->assertSessionHas('errors'); 
        $this->assertGuest();
    }

    public function test_email_login_with_correct_password(){

        $user = $this->user_registered_after_email_verification();

        $response = $this->post('/login', [
            'email' => 'mark@codinglabs.com.au',
            'password' => 'password'
        ]);
        $response->assertRedirect('/dashboard'); 

        $this->assertDatabaseHas('users', [
            'email' => 'mark@codinglabs.com.au'
        ]);
    }



    //User Factory
    public function user_registered_before_email_verification(){
        return User::factory()->create([
            'name' => 'Mark',
            'email' => 'mark@codinglabs.com.au',
            'email_verified_at' => null,
            'password' => bcrypt('password'),
            'provider' => null,
            'provider_id' => null,
        ]);        
    }

    public function user_registered_after_email_verification(){
        return User::factory()->create([
            'name' => 'Mark',
            'email' => 'mark@codinglabs.com.au',
            'email_verified_at' => '2022-07-31 16:14:12',
            'password' => bcrypt('password'),
            'provider' => null,
            'provider_id' => null,
        ]);        
    }

    public function user_registered_with_google(){
        return User::factory()->create([
            'name' => 'Mark',
            'email' => 'mark@codinglabs.com.au',
            'email_verified_at' => '2022-07-31 16:14:12',
            'password' => null,
            'provider' => 'google',
            'provider_id' => Str::random(10),
        ]);        
    }

}
