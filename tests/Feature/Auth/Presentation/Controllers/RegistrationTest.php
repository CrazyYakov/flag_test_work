<?php

namespace Tests\Feature\Auth\Presentation\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;

    public function testSuccessCreated(): void
    {
        $payload = [
            'email' => $this->faker->email,
            'password' => 'password',
            'name' => 'John Doe',
            'password_confirmation' => 'password',
        ];

        $this->postJson('/api/auth/registration', $payload)
            ->assertCreated();
    }

    public function testExistUser(): void
    {
        $email = $this->faker->email;

        User::factory()
            ->set('email', $email)
            ->create();

        $payload = [
            'email' => $email,
            'password' => 'password',
            'name' => 'John Doe',
            'password_confirmation' => 'password',
        ];

        $this->postJson('/api/auth/registration', $payload)
            ->assertUnprocessable();
    }
}
