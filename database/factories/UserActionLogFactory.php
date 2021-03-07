<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\UserActionLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserActionLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserActionLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'book_id' => Book::factory()->create(['isbn' => '0978108248']),
            'action' => UserActionLog::BOOK_CHECK_IN,
        ];
    }
}
