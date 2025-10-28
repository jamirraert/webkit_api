<?php

namespace Tests\Feature;

use App\Models\User;
use App\services\AuthInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;

    public function test_user_can_register(): void
    {
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Password123*',
            'password_confirmation' => 'Password123*',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_user_can_login():void
    {
        $password = 'Windows1*';
        $user = User::factory()->create([
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password
        ]);

        $payload = [
            'email' => $user->email,
            'password' => $password
        ];

        $response = $this->postJson('/api/login', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_user_can_logout():void
    {
        $password = 'Windows1*';
        $user = User::factory()->create([
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password
        ]);

        $token = AuthInterface::generateToken($user);

        $response = $this->postJson('/api/logout', [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }
}
