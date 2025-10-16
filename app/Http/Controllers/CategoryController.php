<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => "Ok",
            'message' => "Categories retrieved successfully",
            'categories' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100|string',
            'slug' => 'required|string',
            'description' => 'required|string',
        ]);

        $category = Category::create($validatedData);

        return response()->json([
            'status' => "Ok",
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => "Error",
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => "Ok",
            'message' => 'Category retrieved successfully',
            'category' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100|string',
            'slug' => 'required|string',
            'description' => 'required|string',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => "Error",
                'message' => 'Category not found'
            ], 404);
        }

        $category->update($validatedData);

        return response()->json([
            'status' => "Ok",
            'message' => 'Category updated successfully',
            'category' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => "Error",
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => "Ok",
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
