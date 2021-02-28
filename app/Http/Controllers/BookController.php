<?php

namespace App\Http\Controllers;

use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use RespondsWithHttpStatus;

    public function index()
    {

    }

    public function show(Book $book)
    {
        return $this->success('Book Retrieved Successfully', [$book]);
    }

    public function update(Book $book)
    {

    }

    public function store()
    {

    }

    public function delete(Book $book)
    {
        $book->delete();

        return $this->success('Book Deleted Successfully');
    }
}
