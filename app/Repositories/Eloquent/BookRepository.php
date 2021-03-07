<?php
namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Support\Collection;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var Book
     */
    protected Book $book;

    /**
     * BookRepository constructor.
     *
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        $this->book = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->book::all();
    }

    /**
     * @param array $validated
     * @return Book
     */
    public function create(array $validated): Book
    {
        $book = new Book();
        $book->title = $validated['title'];
        $book->isbn = $validated['isbn'];
        $book->published_at = $validated['published_at'];
        $book->status = 'AVAILABLE';
        $book->save();

        return $book;
    }

    public function find(int $id): Book
    {
        return $this->book::find($id);
    }
}
