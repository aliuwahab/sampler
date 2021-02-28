<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\Book;
use App\Rules\ValidIban;

class BookController extends Controller
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $books = Book::all();

        return $this->success('Books Retrieved Successfully', $books);
    }

    public function show(Book $book)
    {
        return $this->success('Book Retrieved Successfully', $book);
    }

    public function update(Book $book)
    {

    }

    public function store(CreateBookRequest $createBookRequest)
    {
        $this->validate($createBookRequest, ['isbn' => new ValidIban()]);

        $validated = $createBookRequest->validated();

        Book::create($validated);

        return $this->success('Book Created Successfully');
    }

    public function delete(Book $book)
    {
        if ($book) {
            $book->delete();
        }

        return $this->success('Book Deleted Successfully');
    }
}
