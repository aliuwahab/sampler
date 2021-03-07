<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invalid_credentials_returns_login_failed()
    {
        $invalidLoginCredentials = ['email' => 'sample@email.com', 'password' => 'invalid'];
        User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->post(route('api.login'), $invalidLoginCredentials, ['Accept' => 'application/json']);

        $response
            ->assertStatus(401)
            ->assertJson(['success' => false, 'message' => 'User Authentication Failed']);
    }


    public function test_valid_credentials_returns_login_success()
    {
        $validEmail = 'valid@email.com';
        $validPassword = 'valid';

        $validLoginCredentials = ['email' => $validEmail, 'password' => $validPassword];
        User::factory()->create(['email' => $validEmail, 'password' => bcrypt($validPassword)]);

        $response = $this->post(route('api.login'), $validLoginCredentials, ['Accept' => 'application/json']);

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true, 'message' => 'User Authenticated successfully']);
    }
}
