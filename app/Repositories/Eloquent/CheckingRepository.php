<?php
namespace App\Repositories\Eloquent;

use App\Events\BookCheck;
use App\Models\UserActionLog;
use App\Repositories\CheckingRepositoryInterface;
use Illuminate\Support\Arr;

class CheckingRepository implements CheckingRepositoryInterface
{

    public function checkIn(array $checkInData): bool
    {
        $action = UserActionLog::BOOK_CHECK_IN;
        $checkInData = Arr::add($checkInData, 'action', $action);
        UserActionLog::create($checkInData);

        BookCheck::dispatch($checkInData['book_id'], $action);

        return true;
    }

    public function checkOut(array $checkout): bool
    {
        $checkoutData = Arr::add($checkout, 'action', UserActionLog::BOOK_CHECK_OUT);
        UserActionLog::create($checkoutData);

        BookCheck::dispatch($checkoutData['book_id'], UserActionLog::BOOK_CHECK_OUT);

        return true;
    }
}
