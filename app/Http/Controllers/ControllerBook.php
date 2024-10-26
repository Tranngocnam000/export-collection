<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ControllerBook extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
                'data' => $books,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $book = Book::create($validatedData);
        if ($book) {
            return response()->json(
                [
                    'code' => Response::HTTP_OK,
                    'success' => true,
                    'data' => $book,
                ],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                [
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'success' => false,
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
                'data' => $book,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $book->update($validatedData);
        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
                'data' => $book,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $book->delete();

        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
            ],
            Response::HTTP_OK
        );
    }
}
