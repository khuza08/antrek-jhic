<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with(['user:id,username', 'category:id,name'])->get();

        $news->each(function ($item) {
            if ($item->image) {
                $header = substr($item->image, 0, 4);
                $mimeType = match (true) {
                    str_starts_with($header, "\xFF\xD8\xFF") => 'image/jpeg',
                    str_starts_with($header, "\x89\x50\x4E\x47") => 'image/png',
                    str_starts_with($header, "GIF8") => 'image/gif',
                    str_starts_with($header, "RIFF") && str_contains($item->image, "WEBP") => 'image/webp',
                    default => 'image/jpeg',
                };
                $item->image = "data:{$mimeType};base64," . base64_encode($item->image);
            }
        });

        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log request untuk debugging
            Log::info('Request data:', [
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'has_image' => $request->has('image'),
                'image_length' => $request->image ? strlen($request->image) : 0
            ]);

            // Validasi input
            $validated = $request->validate([
                'user_id'     => 'required|integer|exists:users,id',
                'category_id' => 'required|integer|exists:categories,id',
                'title'       => 'required|string|max:255',
                'excerpt'     => 'required|string',
                'content'     => 'required|string',
                'image'       => 'nullable|string',
            ]);

            $imageData = null;

            if ($request->filled('image')) {
                $image = $request->image;

                // Hapus prefix data URL jika ada
                if (preg_match('/^data:image\/[a-z]+;base64,/', $image)) {
                    $image = preg_replace('/^data:image\/[a-z]+;base64,/', '', $image);
                }

                // Decode base64 ke binary
                $imageData = base64_decode($image, true);

                // Validasi hasil decode
                if ($imageData === false || empty($imageData)) {
                    return response()->json([
                        'message' => 'Format gambar tidak valid',
                    ], 422);
                }
            }

            // Create news
            $news = News::create([
                'user_id'     => $validated['user_id'],
                'category_id' => $validated['category_id'],
                'title'       => $validated['title'],
                'excerpt'     => $validated['excerpt'],
                'content'     => $validated['content'],
                'image'       => $imageData,
            ]);

            Log::info("News created: ID {$news->id}, image: " . ($imageData ? strlen($imageData) . ' bytes' : 'NO'));

            // Prepare response tanpa binary image
            $responseData = $news->toArray();
            unset($responseData['image']);

            return response()->json([
                'message' => 'Berita berhasil ditambahkan!',
                'data'    => $responseData,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating news: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::with(['user', 'category'])->findOrFail($id);

        // Convert image to base64 if exists
        if ($news->image) {
            $header = substr($news->image, 0, 4);
            $mimeType = match (true) {
                str_starts_with($header, "\xFF\xD8\xFF") => 'image/jpeg',
                str_starts_with($header, "\x89\x50\x4E\x47") => 'image/png',
                str_starts_with($header, "GIF8") => 'image/gif',
                str_starts_with($header, "RIFF") && str_contains($news->image, "WEBP") => 'image/webp',
                default => 'image/jpeg',
            };
            $news->image = "data:{$mimeType};base64," . base64_encode($news->image);
        }

        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $news = News::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|exists:users,id',
                'category_id' => 'sometimes|exists:categories,id',
                'title' => 'sometimes|string|max:255',
                'excerpt' => 'sometimes|string',
                'content' => 'sometimes|string',
                'image' => 'nullable|string',
            ]);

            $updateData = [
                'user_id' => $request->user_id ?? $news->user_id,
                'category_id' => $request->category_id ?? $news->category_id,
                'title' => $request->title ?? $news->title,
                'excerpt' => $request->excerpt ?? $news->excerpt,
                'content' => $request->content ?? $news->content,
            ];

            if ($request->has('image') && $request->image) {
                $image = $request->image;

                // Remove data URL prefix
                if (preg_match('/^data:image\/[a-z]+;base64,/', $image)) {
                    $image = preg_replace('/^data:image\/[a-z]+;base64,/', '', $image);
                }

                $imageData = base64_decode($image, true);
                if ($imageData !== false && !empty($imageData)) {
                    $updateData['image'] = $imageData;
                    Log::info("Updating image for news ID {$id}");
                }
            }

            $news->update($updateData);

            // Remove image from response
            $responseData = $news->toArray();
            unset($responseData['image']);

            return response()->json([
                'message' => 'Berita berhasil diperbarui!',
                'data' => $responseData,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating news: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat update berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $news = News::findOrFail($id);
            $news->delete();

            return response()->json(['message' => 'Berita berhasil dihapus!']);
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}