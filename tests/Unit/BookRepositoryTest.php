<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Database\Factories\BookFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BookRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserRepositoryInterface
     */
    protected $bookRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookRepository = resolve(BookRepositoryInterface::class);
    }


    public function test_can_create_a_book()
    {
        $book = Book::factory()->make()->toArray();
        $this->bookRepository->create($book);

        $this->assertDatabaseHas('books', ['title' => $book['title']]);
    }

    public function test_can_find_a_book()
    {
        $book = Book::factory()->create();
        $foundBook = $this->bookRepository->find($book->id);

        $this->assertEquals($book->title, $foundBook->title);
        $this->assertEquals($book->isbn, $foundBook->isbn);
    }

    public function test_can_fetch_all_books_created()
    {
        collect(BookFactory::validIbans())->each(function ($item, $key){
            Book::factory()->create(['isbn' => $item]);
        });

        $queryBooks = $this->bookRepository->all();

        $this->assertEquals(collect(BookFactory::validIbans())->count(), $queryBooks->count());
    }
}
