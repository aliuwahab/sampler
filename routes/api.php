<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('api.login');
Route::post('/users', [UserController::class, 'store'])->name('api.create.user');


Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logOut'])->name('api.logout');

    Route::get('/users', [UserController::class, 'index'])->name('api.users');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('api.show.user');

    Route::get('/books', [BookController::class, 'index'])->name('api.books');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('api.show.book');
    Route::post('/books', [BookController::class, 'store'])->name('api.create.book');


    Route::post('/check-in', [CheckingController::class, 'checkIn'])->name('api.checkin');
    Route::post('/check-out', [CheckingController::class, 'checkOut'])->name('api.checkout');
});


