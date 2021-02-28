<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Database\Factories\BookFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create 10 users using the model factories
         User::factory(10)->create();

         //Build a collection of books to avoid multiple entries
         $books = collect([]);
         collect(BookFactory::validIbans())->each(function ($item, $key) use($books){
             $books[] = Book::factory()->make(['isbn' => $item]);
         });

         //Insert all 20 books at onces...performance.
         DB::table('books')->insert($books->toArray());
    }
}
