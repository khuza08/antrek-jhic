<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
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
            'Status' => "Ok",
            'Message' => "Categories get all data successfully",
            'categories' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100|string',
            'slug' => 'required|string',
            'description' => 'required|string',
        ]);

        $categories = Category::create($validateData);

        return response()->json([
            "Status" => "Ok",
            'message' => 'Categories created successfully',
            'categories' => $categories
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100|string',
            'slug' => 'required|string',
            'description' => 'required|string',
        ]);

        $categories = Category::where('id', $id)->update($validateData);

        return response()->json([
            'status' => "Ok",
            'message' => 'Categories updated successfully',
            'categories' => $categories
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryId = Category::findOrFail($id);
        $categoryId->delete();

        return response()->json([
            'status' => "Ok",
            'message' => 'Categories deleted successfully',
        ], 200);
    }
}
