<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookAuthor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    // Handle Match Route and send appropriate response
    // public function index(Request $request)
    // {
    //     switch ($request->method()) {
    //         case 'POST':
    //             # code...
    //
    //             return $this->store($request);
    //             break;

    //         case 'GET':
    //             return $this->fetchBooks();
    //             break;
    //         default:
    //             # code...
    //             break;
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     switch ($request->method()) {
    //         case 'PATCH':
    //             # code...
    //             return $this->patch($request, $id);
    //             break;

    //         case 'GET':
    //             return $this->show($id);
    //             break;
    //         default:
    //             # code...
    //             break;
    //     }
    // }


    // Fetch All Books From Database
    public function index()
    {
        try {
            //code...
            $books = Book::orderBy('created_at', 'desc')->get();
            return response()->json([
                'data' => $books,
                'status_code' => 200,
                'status' => 'success'
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Add New Book to Database
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|bail|string',
                'isbn' => 'required|bail|string',
                'number_of_pages' => 'required|bail|integer|numeric',
                'publisher' => 'required|bail|string',
                'country' => 'required|bail|string',
                'release_date' => 'required|bail|date',
                'authors.*' => 'required|bail',
            ]);

            $book = new Book();
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->number_of_pages = $request->number_of_pages;
            $book->publisher = $request->publisher;
            $book->country = $request->country;
            $book->release_date = $request->release_date;
            $book->save();

            if ($request->authors != null) {
                foreach ($request->authors as $key => $author) {

                    Log::alert($author);
                    $book_author = new BookAuthor();
                    $book_author->name = $author;
                    $book_author->book_id = $book->id;
                    Log::alert($book->id);
                    $book_author->save();
                }
            }

            return response()->json([
                'data' => $book,
                'status_code' => 200,
                'status' => 'success'
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Update Book information in the Database
    public function patch(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'bail|string',
                'isbn' => 'bail|string',
                'number_of_pages' => 'bail|integer|numeric',
                'publisher' => 'bail|string',
                'country' => 'bail|string',
                'release_date' => 'bail|date',
                'authors.*' => 'bail',
            ]);

            $book = Book::find($id);
            $book->name = $request->name == null ? $book->name : $request->name;
            $book->isbn = $request->isbn == null ? $book->isbn : $request->isbn;
            $book->number_of_pages = $request->number_of_pages == null ? $book->number_of_pages : $request->number_of_pages;
            $book->publisher = $request->publisher == null ? $book->publisher : $request->publisher;
            $book->country = $request->country == null ? $book->country : $request->country;
            $book->release_date = $request->release_date == null ? $book->release_date : $request->release_date;
            $book->save();

            if ($request->authors != null) {
                $existing_authors = BookAuthor::where('book_id', $id)->get();
                foreach ($existing_authors as $existing_author) {
                    $existing_author->delete();
                }

                foreach ($request->authors as $key => $author) {
                    $book_author = new BookAuthor();
                    $book_author->name = $author;
                    $book_author->book_id = $book->id;
                    $book_author->save();
                }
            }

            $message = 'The book ' . $book->name . ' was updated successfully';

            return response()->json([
                'data' => $book,
                'status_code' => 200,
                'status' => 'success',
                'message' => $message
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Delete book from database
    public function delete($id)
    {
        try {
            //code...
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->json([
                'data' => $book,
                'status_code' => 200,
                'status' => 'success',
                "message" => "The book '" . $book->name . "' was deleted successfully",
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Show Specific Book Detail
    public function show($id)
    {
        try {
            //code...
            $book = Book::findOrFail($id);
            return response()->json([
                'data' => $book,
                'status_code' => 200,
                'status' => 'success'
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            //code...
            $query = $request->query;
            $books = Book::where('name', 'LIKE', "%$query%")->orWhere('country', 'LIKE', "%$query%")->orWhere('publisher', 'LIKE', "%$query%")->orWhere('release_date', 'LIKE', "%$query%")->get();
            // $products = Product::with('product_variants')->with('category')->with('designer')->where('name', 'LIKE', "%$query%")->paginate(2);
            return response()->json([
                'data' => $books,
                'status_code' => 200,
                'status' => 'success'
            ], 200);
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Make
    public function externalApi(Request $request)
    {
        try {
            //code...
            $name = $request->name;
            $external_link = $name == "" ? 'https://www.anapioficeandfire.com/api/books' : 'https://www.anapioficeandfire.com/api/books?name=' . $name;

            $books = [];

            $response = Http::get($external_link);
            $response_data = json_decode($response);
            foreach ($response_data as $key => $data) {
                Log::alert($data->name);
                $payload = (object) array(
                    'name' => $data->name,
                    'isbn' => $data->isbn,
                    'authors' => $data->authors,
                    'number_of_pages' => $data->numberOfPages,
                    'publisher' => $data->publisher,
                    'country' => $data->country,
                    'release_date' => Carbon::parse($data->released)->toDate()->format('Y-m-d'),
                );

                array_push($books, $payload);
            }

            // Log::alert($response);

            if ($response->status() == 200) {
                return response()->json([
                    'data' => $books,
                    'status_code' => 200,
                    'status' => 'success'
                ], 200);
            } else {
                return redirect()->back()->with('error', $response['message']);
            }
        } catch (ValidationException $th) {
            Log::info($th);
            return response()->json(['error' => $th->validator->errors()->first()], 422);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
