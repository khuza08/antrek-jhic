<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', '!=', 'Admin');
            })
            ->get();

        $teachers->transform(function (\App\Models\Teacher $t) {
            if ($t->image) {
                $t->image = 'data:image/jpeg;base64,' . base64_encode($t->image);
            } else {
                $t->image = null;
            }
            return $t;
        });

        return response()->json($teachers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rate' => 'nullable|numeric|min:0|max:5'
        ]);

        $imageData = null;
        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->file('image')->getRealPath());
        }

        $teacher = Teacher::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageData,
            'rate' => $request->rate
        ]);

        // jangan kirim binary ke response JSON
        $teacher->makeHidden(['image']);

        return response()->json([
            'message' => 'Teacher created successfully',
            'data' => $teacher
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with('role')->findOrFail($id);

        if ($teacher->image) {
            $teacher->image = 'data:image/jpeg;base64,' . base64_encode($teacher->image);
        }

        return response()->json($teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'role_id' => 'sometimes|required|exists:roles,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rate' => 'nullable|numeric|min:0|max:5'
        ]);

        $imageData = $teacher->image;
        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->file('image')->getRealPath());
        }

        $teacher->update([
            'role_id' => $request->role_id ?? $teacher->role_id,
            'name' => $request->name ?? $teacher->name,
            'description' => $request->description ?? $teacher->description,
            'image' => $imageData,
            'rate' => $request->rate ?? $teacher->rate
        ]);

        $teacher->makeHidden(['image']);

        return response()->json([
            'message' => 'Teacher updated successfully',
            'data' => $teacher
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json([
            'message' => 'Teacher deleted successfully'
        ]);
    }
}
