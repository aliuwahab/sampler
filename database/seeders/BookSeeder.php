<?php

namespace Database\Seeders;

use App\Models\Book;
use Database\Factories\BookFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Build a collection of books (using the make method) to avoid multiple db hits
        $books = collect([]);
        collect(BookFactory::validIbans())->each(function ($item, $key) use($books){
            $books[] = Book::factory()->make(['isbn' => $item]);
        });

        //Insert all 20 books that were generated above at ones...performance.
        DB::table('books')->insert($books->toArray());
    }
}
