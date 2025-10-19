<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with(['user:id,username,email', 'category:id,name'])->get();

        // Ubah data biner menjadi Base64 agar bisa ditampilkan di frontend
        $galleries->transform(function ($gallery) {
            if ($gallery->image) {
                $gallery->image = 'data:image/jpeg;base64,' . base64_encode($gallery->image);
            }
            return $gallery;
        });

        return response()->json($galleries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $imageData = file_get_contents($request->file('image')->getRealPath());

            $gallery = Gallery::create([
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'image' => $imageData
            ]);

            // ✅ sembunyikan field image (karena biner)
            $gallery->makeHidden(['image']);

            return response()->json([
                'message' => 'Gallery created successfully',
                'data' => $gallery
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::with(['user', 'category'])->findOrFail($id);

        if ($gallery->image) {
            $gallery->image = 'data:image/jpeg;base64,' . base64_encode($gallery->image);
        }

        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $updateData = [
            'user_id' => $request->user_id ?? $gallery->user_id,
            'category_id' => $request->category_id ?? $gallery->category_id,
            'title' => $request->title ?? $gallery->title,
        ];

        // Jika ada file baru, baca ulang binary-nya
        if ($request->hasFile('image')) {
            $updateData['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $gallery->update($updateData);
        $gallery->makeHidden(['image']);

        return response()->json([
            'message' => 'Gallery updated successfully',
            'data' => $gallery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json([
            'status' => "Ok",
            'message' => 'Gallery deleted successfully'
        ]);
    }
}