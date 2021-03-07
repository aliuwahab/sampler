<?php

namespace App\Listeners;

use App\Events\BookCheck;
use App\Models\Book;
use App\Models\UserActionLog;

class UpdateBookAvailabilityStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookCheck  $event
     * @return void
     */
    public function handle(BookCheck $event)
    {
        $book = Book::find($event->bookId);

        if (! $book) return;

        if ($event->checkType === UserActionLog::BOOK_CHECK_IN) {
            $book->status = 'AVAILABLE';
        }else {
            $book->status = 'CHECKED_OUT';
        }

        $book->save();
    }
}
