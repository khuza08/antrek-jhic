<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with([
            'user:id,username,email',
            'category:id,name'
        ])->get();
        return response()->json($news);
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
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // $slug = Str::slug($request->title, '-');
        $imagePath = $request->file('image')->store('news', 'public');

        $news = News::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            // 'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        return response()->json([
            'message' => 'News created successfully',
            'data' => $news
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::with(['user', 'category'])->findOrFail($id);
        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'excerpt' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // $slug = $news->slug;
        // if ($request->has('title')) {
        //     $slug = Str::slug($request->title, '-');
        // }

        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        $news->update([
            'user_id' => $request->user_id ?? $news->user_id,
            'category_id' => $request->category_id ?? $news->category_id,
            'title' => $request->title ?? $news->title,
            // 'slug' => $slug,
            'excerpt' => $request->excerpt ?? $news->excerpt,
            'content' => $request->content ?? $news->content,
            'image' => $imagePath
        ]);

        return response()->json([
            'message' => 'News updated successfully',
            'data' => $news
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully'
        ]);
    }
}