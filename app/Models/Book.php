<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    const STATUS_AVAILABLE = 'AVAILABLE';
    const STATUS_CHECKED_OUT = 'CHECKED_OUT';

    protected $guarded = ['id'];


}
