<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\support\Facades\Log;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $achievements = Achievement::with(['user', 'category'])->get();
        return response()->json($achievements, 200, [], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $user = auth()->user();
            // if (!$user) {
            //     return response()->json(['message' => 'Unauthorized'], 403);
            // }

            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'excerpt' => 'nullable|string|max:500',
                'rank' => 'nullable|string|max:100',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'date' => 'required|date'
            ]);

            $imageData = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $imageData = file_get_contents($file->getRealPath());
            }

            $achievement = Achievement::create([
                'user_id' => 1,
                'category_id' => $request->category_id,
                'title' => $request->title,
                // 'slug' => Str::slug($request->title),
                'description' => $request->description,
                'excerpt' => $request->excerpt,
                'rank' => $request->rank,
                'image' => $imageData,
                'date' => $request->date
            ]);

            return response()->json([
                'message' => 'Achievement created successfully',
                'data' => $achievement
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating achievement: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create achievement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $achievement = Achievement::with(['user', 'category'])->findOrFail($id);

        if (!$achievement->user) {
            $achievement->user = (object) ['name' => 'User Tidak Ditemukan'];
        }
        if (!$achievement->category) {
            $achievement->category = (object) ['name' => 'Kategori Tidak Ditemukan'];
        }

        return response()->json($achievement, 200, [], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $achievement = Achievement::findOrFail($id);

            $request->validate([
                'category_id' => 'nullable|exists:categories,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'excerpt' => 'nullable|string|max:500',
                'rank' => 'nullable|string|max:100',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'date' => 'required|date'
            ]);

            // Gunakan nilai asli dari database (binary)
            $imageData = $achievement->getRawOriginal('image');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageData = file_get_contents($file->getRealPath());
            }

            $achievement->update([
                'user_id' => 1,
                'category_id' => $request->category_id,
                'title' => $request->title,
                // 'slug' => $request->title ? Str::slug($request->title) : $achievement->slug,
                'description' => $request->description,
                'excerpt' => $request->excerpt,
                'rank' => $request->rank,
                'image' => $imageData,
                'date' => $request->date
            ]);

            // Refresh model agar accessor getImageAttribute() dipanggil lagi
            $achievement->refresh();

            return response()->json([
                'message' => 'Achievement updated successfully',
                'data' => $achievement
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating achievement: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update achievement',
                'error' => $e->getMessage()
            ], 500);
        }
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