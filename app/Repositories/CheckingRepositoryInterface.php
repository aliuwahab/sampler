<?php
namespace App\Repositories;

interface CheckingRepositoryInterface
{
    public function checkIn(array $checkInData): bool;

    public function checkOut(array $checkout): bool;
}
