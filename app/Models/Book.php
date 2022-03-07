<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table  = 'books';

    protected $appends = ['authors'];

    protected $hidden = ['book_authors', 'created_at', 'updated_at'];

    //Primary Key
    public $primaryKey = 'id';

    // Timestamsp
    public $timestamps = true;

    public function book_authors()
    {
        return $this->hasMany(BookAuthor::class);
    }

    public function getAuthorsAttribute()
    {
        $authors = [];
        foreach ($this->book_authors as $book_author) {
            array_push($authors, $book_author->name);
        }
        return $authors;
    }
}
