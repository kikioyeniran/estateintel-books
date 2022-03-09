<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function createBook()
    {
        $book = new Book();
        $book->name = "My First Book";
        $book->isbn = "123-3213243567";
        $book->number_of_pages = 350;
        $book->publisher = "Acme Books Publishing";
        $book->country = "United States";
        $book->release_date = "2019-01-01";
        $book->save();

        $authors = ["Maya Angeloud"];

        if ($authors != null) {
            foreach ($authors as $key => $author) {
                $book_author = new BookAuthor();
                $book_author->name = $author;
                $book_author->book_id = $book->id;
                $book_author->save();
            }
        }

        return $book;
    }

    public function testBookCreate()
    {
        $authors = ['Maya Angelou'];
        $response = $this->json('POST', route('books.index'), [
            "name" => "My First Book",
            "isbn" => "123-3213243567",
            "authors" => [
                "John Doe"
            ],
            "number_of_pages" => 350,
            "publisher" => "Acme Books Publishing",
            "country" => "United States",
            "release_date" => "2019-01-01"

        ]);
        $response->assertStatus(200);
    }

    public function testBookIndex()
    {
        $response = $this->json('GET', route('books.index'));
        $response->assertStatus(200);
    }

    public function testBookUpdate()
    {
        // $authors = ['Maya Angelou'];
        $new_book = $this->createBook();

        Log::alert($new_book->id);

        $response = $this->json('PATCH', route('books.patch', $new_book->id), [
            'name' => 'Another Name',
        ]);

        $response->assertStatus(200);
    }

    public function testBookShow()
    {
        $new_book = $this->createBook();

        $response = $this->json('GET', route('books.show', $new_book->id));
        $response->assertStatus(200);
    }

    public function testBookDelete()
    {
        $new_book = $this->createBook();

        $response = $this->json('DELETE', route('books.show', $new_book->id));
        $response->assertStatus(200);
    }

    public function testBookExternalApi()
    {
        $response = $this->json('GET', route('books.external-api'));
        $response->assertStatus(200);
    }
}
