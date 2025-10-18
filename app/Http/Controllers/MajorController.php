<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua jurusan beserta kategori
        $majors = Major::with('category')->get();

        return response()->json($majors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:majors,name',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string'
        ]);

        $major = Major::create($validated);

        return response()->json([
            'message' => 'Major created successfully',
            'data' => $major->load('category')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $major = Major::with('category')->findOrFail($id);
        return response()->json($major);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Major::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:majors,name,' . $id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string'
        ]);

        $major->update($validated);

        return response()->json([
            'message' => 'Major updated successfully',
            'data' => $major->load('category')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return response()->json([
            'message' => 'Major deleted successfully'
        ]);
    }
}
