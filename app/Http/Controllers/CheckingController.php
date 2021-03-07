<?php

namespace App\Http\Controllers;

use App\Events\BookCheck;
use App\Http\Requests\CheckInRequest;
use App\Http\Requests\CheckOutRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\Book;
use App\Models\UserActionLog;
use Illuminate\Support\Arr;

class CheckingController extends Controller
{
    use RespondsWithHttpStatus;

    public function checkIn(CheckInRequest $checkInRequest)
    {
        $action = BookCheck::BOOK_CHECK_IN;
        $validated = $checkInRequest->validated();

        $existingCheckIn = UserActionLog::where('book_id', $validated['book_id'])->where('user_id', $validated['user_id'])->first();

        if (! $existingCheckIn || $existingCheckIn->action !== UserActionLog::BOOK_CHECK_OUT) {
            return $this->failure("You cannot check-in a book you've not checkout");
        }

        $validated = Arr::add($validated, 'action', $action);
        UserActionLog::create($validated);

        BookCheck::dispatch($validated['book_id'], $action);

        return $this->success('Book Check-in successfully');
    }

    public function checkOut(CheckOutRequest $checkOutRequest)
    {
        $action = BookCheck::BOOK_CHECK_OUT;
        $validated = $checkOutRequest->validated();

        $findBook = Book::where('id', $validated['book_id'])->first();

        if (!$findBook || $findBook->status === Book::STATUS_CHECKED_OUT) {
            return $this->failure('Book not available for checkout.');
        }

        $checkInData = Arr::add($validated, 'action', UserActionLog::BOOK_CHECK_OUT);

        $checkOut = UserActionLog::create($checkInData);

        BookCheck::dispatch($checkOut->book_id, $action);

        return $this->success('Book Check-Out successfully');
    }
}
