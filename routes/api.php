<?php

use App\Http\Controllers\api\BookController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Route::match(['get', 'post'], '/books', [BookController::class, 'index'])->name('books.index');

    // Route::match(['patch', 'get'], '/books/{id}', [BookController::class, 'update'])->name('books.update');

    Route::post('/books', [BookController::class, 'index'])->name('books.index');

    Route::post('/books', [BookController::class, 'store'])->name('books.create');

    Route::patch('/books/{book}', [BookController::class, 'patch'])->name('books.patch');

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::delete('/books/{id}', [BookController::class, 'delete'])->name('books.delete');

    Route::get('/external-books', [BookController::class, 'externalApi'])->name('books.external-api');
});
