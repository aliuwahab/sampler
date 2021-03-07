<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    use HasFactory;

    const BOOK_CHECK_IN = 'CHECKIN';
    const BOOK_CHECK_OUT = 'CHECKOUT';

    protected $guarded = ['id'];

}
