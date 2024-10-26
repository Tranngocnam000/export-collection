<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ControllerCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
                'data' => $categories,
            ],
            Response::HTTP_OK
        );
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validatedData);
        if ($category) {
            return response()->json(
                [
                    'code' => Response::HTTP_OK,
                    'success' => true,
                    'data' => $category,
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
        $category = Category::find($id);

        if (!$category) {
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
                'data' => $category,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     * (Usually not needed in an API controller, so leave this empty or remove it)
     */
    public function edit(string $id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
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
        ]);

        $category->update($validatedData);
        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
                'data' => $category,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $category->delete();

        return response()->json(
            [
                'code' => Response::HTTP_OK,
                'success' => true,
            ],
            Response::HTTP_OK
        );
    }
}
