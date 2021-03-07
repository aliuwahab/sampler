<?php

namespace Tests\Unit;

use App\Events\BookCheck;
use App\Models\Book;
use App\Models\User;
use App\Models\UserActionLog;
use App\Repositories\CheckingRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CheckingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CheckingRepositoryInterface $checkinRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->checkinRepository = resolve(CheckingRepositoryInterface::class);
    }

    public function test_can_checkin()
    {
        Event::fake();

        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_AVAILABLE]);
        UserActionLog::factory()->create(['user_id' => $user->id, 'book_id' => $book->id, 'action' => UserActionLog::BOOK_CHECK_OUT]);
        $checkInData = ['book_id' => $book->id, 'user_id' => $user->id];

        $this->checkinRepository->checkIn($checkInData);

        $this->assertDatabaseHas('user_action_logs', $checkInData);

        Event::assertDispatched(BookCheck::class);
    }

    public function test_can_checkout()
    {
        Event::fake();

        $user = User::factory()->create();
        $book = Book::factory()->create(['isbn' => '0978110196', 'status' => Book::STATUS_AVAILABLE]);
        $checkOutData = ['book_id' => $book->id, 'user_id' => $user->id];

        $checkout = $this->checkinRepository->checkOut($checkOutData);

        $this->assertTrue($checkout);
        $this->assertDatabaseHas('user_action_logs', $checkOutData);

        Event::assertDispatched(BookCheck::class);
    }
}
