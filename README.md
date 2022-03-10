<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Estate Intel Recruitment CRUD API DOCUMENTATIONS

<p align="left">This project was built with the very powerful and efficient Laravel PHP Framework.

To run this application, clone this repository then run this command
<br>

<code>composer install</code>

This will set up all the project dependencies, packages and the like.

</p>

<p align="left">
    After that run this command
    <br><code>php artisan migrate</code>
    <br>
    This will set up the database and run all the migrations
</p>
<p align="left">
    Finally run this command to get the application running
    <br><code>php artisan serve</code>
    <br>
    With this the applicatio should be up and running.
</p>
<p align="left">
    To run the test scripts, run this command
    <br><code>php artisan test</code>
    <br>
    Only run this after setting up the application
</p>
<p align="left">
    For your convenience I have published a postman documentation that can easily be used to test these endpoint <br>
    Click this link to view it
    <br><a href="https://documenter.getpostman.com/view/7811904/UVsFyoZa">POSTMAN DOCUMENTATION (https://documenter.getpostman.com/view/7811904/UVsFyoZa)</a>
    <br>
    Only run this after setting up the application
</p>

<p align="left">
    Below is a list of API endpoints and how to use them
    <br>
    1. Fetch Books (GET REQUEST)
    <br><code>http://estate-intel.dop/api/v1/books</code>
    <br>
    This will Fetch Books Already Added to the Database. <br>
    The API response should look like this
    <br><code>
    {
        "data": [
            {
                "id": 5,
                "name": "Knives Inside",
                "isbn": "978-0553103540",
                "number_of_pages": 490,
                "publisher": "Bantam Sons",
                "country": "Nigeria",
                "release_date": "1996-01-01",
                "authors": [
                    "Maya Angelou"
                ]
            }
        ],
        "status_code": 200,
        "status": "success"
    }
</code>
</p>
<p align="left">
    <br>
    2. Create or Add New Book (POST REQUEST)
    <br><code>http://estate-intel.dop/api/v1/books</code>
    <br>
    Add a new book object to the database<br>
    The API response should look like this <br>
    The payload should follow this pattern:
    name (Valid Name String) <br>
    isbn    (Example: 978-0553103540) <br>
    authors[] String name of authors (accepts an array) <br>
    publisher    Valid Publisher name string <br>
    country    Country name string <br>
    release_date    Valid Date String <br>
    number_of_pages Integer number of book pages <br>
    The result should look like this
<br><code>
    {
    "data": [
        {
        "id": 5,
        "name": "Knives Inside",
        "isbn": "978-0553103540",
        "number_of_pages": 490,
        "publisher": "Bantam Sons",
        "country": "Nigeria",
        "release_date": "1996-01-01",
        "authors": [
        "Maya Angelou"
        ]
        }
        ],
    "status_code": 200,
    "status": "success"
    }
</code>
</p>

<p align="left">
    Below is a list of API endpoints and how to use them
    <br>
    3. External Books API (GET REQUEST)
    <br><code>http://estate-intel.dop/api/v1/external-books</code>
    <br>
    Fetch books from external fire and ice API
    With an optional name search query parameter to filter the request results <br>
    The API response should look like this
    <br><code>
    {
        "data": [
            {
                "id": 5,
                "name": "Knives Inside",
                "isbn": "978-0553103540",
                "number_of_pages": 490,
                "publisher": "Bantam Sons",
                "country": "Nigeria",
                "release_date": "1996-01-01",
                "authors": [
                    "Maya Angelou"
                ]
            }
        ],
        "status_code": 200,
        "status": "success"
    }
</code>

<p align="left">
    <br>
    4. Update Book (PATCH REQUEST)
    <br><code>http://estate-intel.dop/api/v1/books/20</code>
    <br>
    Update book object to the database<br>
    The API response should look like this <br>
    The payload should follow this pattern:
    name (Valid Name String) <br>
    isbn    (Example: 978-0553103540) <br>
    authors[] String name of authors (accepts an array) <br>
    publisher    Valid Publisher name string <br>
    country    Country name string <br>
    release_date    Valid Date String <br>
    number_of_pages Integer number of book pages <br>
    The result should look like this
<br><code>
    {
    "data": [
        {
        "id": 5,
        "name": "Knives Inside",
        "isbn": "978-0553103540",
        "number_of_pages": 490,
        "publisher": "Bantam Sons",
        "country": "Nigeria",
        "release_date": "1996-01-01",
        "authors": [
        "Maya Angelou"
        ]
        }
        ],
"   status_code": 200,
    "status": "success",
    "message": "The book My New Name was updated successfully"    }
</code>
</p>
<p align="left">
    <br>
    5. View Single Book (GET REQUEST)
    <br><code>http://estate-intel.dop/api/v1/books/20</code>
    <br>
    This will Fetch A Single Book Already Added to the Database. <br>
    The API response should look like this
    <br><code>
    {
        "data": [
            {
                "id": 5,
                "name": "Knives Inside",
                "isbn": "978-0553103540",
                "number_of_pages": 490,
                "publisher": "Bantam Sons",
                "country": "Nigeria",
                "release_date": "1996-01-01",
                "authors": [
                    "Maya Angelou"
                ]
            }
        ],
        "status_code": 200,
        "status": "success"
    }
</code>
</p>
<p align="left">
    <br>
    6. Delete Single Book (DELETE REQUEST)
    <br><code>http://estate-intel.dop/api/v1/books/20</code>
    <br>
    This will Delete A Single Book Already Added to the Database. <br>
    The API response should look like this
    <br><code>
    {
        "data": [
            {
                "id": 5,
                "name": "Knives Inside",
                "isbn": "978-0553103540",
                "number_of_pages": 490,
                "publisher": "Bantam Sons",
                "country": "Nigeria",
                "release_date": "1996-01-01",
                "authors": [
                    "Maya Angelou"
                ]
            }
        ],
        "status_code": 200,
        "status": "success"
         "message": "The book 'My New Name' was deleted successfully"
    }
</code>
</p>
<!-- <p align="left">
    <br><code></code>
    <br>
</p>
<p align="left">
    <br><code></code>
    <br>
</p> -->
