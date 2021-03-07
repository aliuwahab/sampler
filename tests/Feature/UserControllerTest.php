<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_validates_required_and_returns_validation_error()
    {
        $inCompleteUserInformation = ['email' => 'test@email.com', 'name' => 'Test'];

        $response = $this->post(route('api.create.user'), $inCompleteUserInformation, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(['message' => 'The given data was invalid.', 'errors' => []]);
    }

    public function test_invalid_email_return_validation_errors()
    {
        $invalidEmailUserData = ['email' => 'invalid_email', 'name' => 'Test', 'date_of_birth' => '1989-04-16', 'password'=>'test',  'password_confirmation'=>'test'];

        $response = $this->post(route('api.create.user'), $invalidEmailUserData, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(['message' => 'The given data was invalid.', 'errors' => ['email' => ['The email must be a valid email address.']]]);
    }


    public function test_email_already_user_returns_validation_error()
    {
        $duplicateEmail = 'duplicate@gmail.com';
        User::factory()->create(['email' => $duplicateEmail]);
        $invalidEmailUserData = ['email' => $duplicateEmail, 'name' => 'Test', 'date_of_birth' => '1989-04-16', 'password'=>'test',  'password_confirmation'=>'test'];

        $response = $this->post(route('api.create.user'), $invalidEmailUserData, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(['message' => 'The given data was invalid.', 'errors' => ['email' => ['The email has already been taken.']]]);
    }



    public function test_valid_data_creates_user_and_returns_success()
    {
        $validUserData = ['email' => 'valid@email.com', 'name' => 'Test', 'date_of_birth' => '1989-04-16', 'password'=>'test',  'password_confirmation'=>'test'];

        $response = $this->post(route('api.create.user'), $validUserData, ['Accept' => 'application/json']);

        $response->assertStatus(200)->assertJson(['success' => true, 'message' => 'User Created Successfully']);
    }


}
