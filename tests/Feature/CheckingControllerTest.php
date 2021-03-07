<?php

namespace Tests\Feature;

use App\Events\BookCheck;
use App\Models\Book;
use App\Models\User;
use App\Models\UserActionLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CheckingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_checkout()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196']);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];
        $response = $this->post(route('api.checkout'), $checkInData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_unauthenticated_user_cannot_checkin()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196']);

        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $response = $this->post(route('api.checkout'), $checkInData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_check_out_validates_required_fields_and_returns_validation_error()
    {
        $user = User::factory()->create();
        $checkInData = [];
        $response = $this->actingAs($user)->post(route('api.checkout'), $checkInData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.', 'errors' => ['book_id' => ['The book id field is required.']]]);
    }

    public function test_it_validates_if_book_is_available_for_checkout()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_CHECKED_OUT]);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $response = $this->actingAs($user)->post(route('api.checkout'), $checkInData, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(['success' => false, 'message' => 'Book not available for checkout.']);
    }


    public function test_valid_data_creates_a_check_in_record()
    {
        Event::fake();

        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_AVAILABLE]);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $response = $this->actingAs($user)->post(route('api.checkout'), $checkInData, ['Accept' => 'application/json']);

        $response->assertJson(['success' => true, 'message' => 'Book Check-Out successfully']);

        Event::assertDispatched(BookCheck::class);

    }


    public function test_check_in_validates_required_fields_and_returns_validation_error()
    {
        $user = User::factory()->create();
        $checkInData = [];
        $response = $this->actingAs($user)->post(route('api.checkin'), $checkInData, ['Accept' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.', 'errors' => ['book_id' => ['The book id field is required.']]]);
    }


    public function test_it_validates_if_user_has_already_gotten_a_checkout_for_the_same_book_before_they_can_check_in()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_AVAILABLE]);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $response = $this->actingAs($user)->post(route('api.checkin'), $checkInData, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(['success' => false, 'message' => "You cannot check-in a book you've not checkout"]);
    }


    public function test_it_can_checkin_if_data_is_valid()
    {
        Event::fake();

        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_AVAILABLE]);
        UserActionLog::factory()->create(['user_id' => $user->id, 'book_id' => $book->id, 'action' => UserActionLog::BOOK_CHECK_OUT]);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $response = $this->actingAs($user)->post(route('api.checkin'), $checkInData, ['Accept' => 'application/json']);

        $response->assertStatus(200)->assertJson(['success' => true, 'message' => "Book Check-in successfully"]);

        Event::assertDispatched(BookCheck::class);
    }
}
