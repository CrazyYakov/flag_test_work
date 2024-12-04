<?php

namespace Api;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_registration()
    {
        $email = fake()->email;
        $password = fake()->password;

        User::query()->firstWhere('email', $email)?->delete();

        $response = $this->postJson('/api/user/registration', [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'name' => fake()->name()
        ]);

        $response->assertCreated();
    }

    public function test_authorization()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/user/authorization', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
    }
}
