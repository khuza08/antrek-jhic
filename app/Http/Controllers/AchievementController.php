<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::with([
            'user:id,username,email',
            'category:id,name'
        ])->get();
        return response()->json($achievements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rank' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('achievements', 'public');
        }

        $achievement = Achievement::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'rank' => $request->rank,
            'image' => $imagePath,
            'date' => $request->date
        ]);

        return response()->json([
            'message' => 'Achievement created successfully',
            'data' => $achievement
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $achievement = Achievement::with(['user', 'category'])->findOrFail($id);
        return response()->json($achievement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $achievement = Achievement::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'rank' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'sometimes|required|date'
        ]);

        $imagePath = $achievement->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update([
            'user_id' => $request->user_id ?? $achievement->user_id,
            'category_id' => $request->category_id ?? $achievement->category_id,
            'title' => $request->title ?? $achievement->title,
            'slug' => $request->title ? Str::slug($request->title) : $achievement->slug,
            'description' => $request->description ?? $achievement->description,
            'rank' => $request->rank ?? $achievement->rank,
            'image' => $imagePath,
            'date' => $request->date ?? $achievement->date
        ]);

        return response()->json([
            'message' => 'Achievement updated successfully',
            'data' => $achievement
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return response()->json([
            'message' => 'Achievement deleted successfully'
        ]);
    }
}
