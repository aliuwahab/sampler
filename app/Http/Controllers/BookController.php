<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Rules\ValidIsbn;

class BookController extends Controller
{
    use RespondsWithHttpStatus;

    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->all();

        return $this->success('Books Retrieved Successfully', $books);
    }

    public function show(int $bookId)
    {
        $book = $this->bookRepository->find($bookId);

        return $this->success('Book Retrieved Successfully', $book);
    }

    public function store(CreateBookRequest $createBookRequest)
    {
        $this->validate($createBookRequest, ['isbn' => new ValidIsbn()]);
        $validated = $createBookRequest->validated();

        $book = $this->bookRepository->create($validated);

        return $this->success('Book Created Successfully', $book);
    }

}
