<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_create_a_book()
    {
        $inCompleteBookInformation = ['isbn' => '0978110196', 'published_at' => now(), 'status' => 'AVAILABLE'];

        $response = $this->post(route('api.create.book'), $inCompleteBookInformation, ['Accept' => 'application/json']);

        $response
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }


    public function test_it_validates_required_fields_and_returns_validation_error()
    {
        $user = User::factory()->create();

        $inCompleteBookInformation = ['isbn' => '0978110196', 'published_at' => now(), 'status' => 'AVAILABLE'];

        $response = $this->actingAs($user)->post(route('api.create.book'), $inCompleteBookInformation, ['Accept' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.', 'errors' => []]);
    }


    public function test_invalid_isbn_returns_validation_error()
    {
        $user = User::factory()->create();

        $invalidIsbnBookData = ['title' => 'Sample Book Title', 'isbn' => '0978110199', 'published_at' => now(), 'status' => 'AVAILABLE'];

        $response = $this->actingAs($user)->post(route('api.create.book'), $invalidIsbnBookData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.', 'errors' => ['isbn' => ['The isbn must be a Valid Iban.']]]);
    }


    public function test_valid_data_creates_book_and_returns_success()
    {
        $user = User::factory()->create();

        $validBookData = ['title' => 'Sample Book Title', 'isbn' => '0978110196', 'published_at' => now(), 'status' => 'AVAILABLE'];

        $response = $this->actingAs($user)->post(route('api.create.book'), $validBookData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(200)
            ->assertJson(['success' => true, 'message' => 'Book Created Successfully']);
    }
}
