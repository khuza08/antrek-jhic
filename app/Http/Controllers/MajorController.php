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
        $majors = Major::all();
        return response()->json($majors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:majors,name',
            'description' => 'nullable|string'
        ]);

        $major = Major::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Major created successfully',
            'data' => $major
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $major = Major::findOrFail($id);
        return response()->json($major);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Major::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:majors,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $major->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Major updated successfully',
            'data' => $major
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
