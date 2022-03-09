<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BookCreate extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
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
}
