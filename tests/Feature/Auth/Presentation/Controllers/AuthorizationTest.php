<?php

namespace Tests\Feature\Auth\Presentation\Controllers;

use App\Models\User;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/authorization', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
    }
}
