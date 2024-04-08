<?php

namespace Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        Tag::factory(10)->create();
        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     */
    public function userCanAddPosts(): void
    {
        $url = route('posts.add');
        $data = [
            'title' => 'Post Title',
            'description' => 'Post Description',
            'tags' => [1, 2, 3],
            'user_id' => $this->user->id,
        ];

        $response = $this->post($url, $data);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function userCanRegister(): void
    {
        $url = route('register');
        $data = [
            'name' => 'Test User',
            'email' => 'newemail@gmail.com',
            'password' => 'password',
        ];

        $response = $this->post($url, $data);

        $response->assertStatus(201);
    }
}
