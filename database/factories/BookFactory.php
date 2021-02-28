<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'isbn' => Arr::random(self::validIbans()),
            'published_at' => now(),
            'status' => Arr::random(['CHECKED_OUT','AVAILABLE']),
            'created_at' => now(),
        ];
    }

    public static function validIbans(): array
    {
        // List of valid Ibans as shared in the challenge
        return [
            '0005534186',
            '0978110196',
            '0978108248',
            '0978194527',
            '0978194004',
            '0978194985',
            '0978171349',
            '0978039912',
            '0978031644',
            '0978168968',
            '0978179633',
            '0978006232',
            '0978195248',
            '0978125029',
            '0978078691',
            '0978152476',
            '0978153871',
            '0978125010',
            '0593139135',
            '0441013597',
        ];
    }


    /**
     * Indicate that the ibans's of the book should be unique.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function uniqueIbans()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
