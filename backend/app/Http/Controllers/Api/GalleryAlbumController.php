<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAlbum;

class GalleryAlbumController extends Controller
{
    public function index()
    {
        return GalleryAlbum::all();
    }

    public function show($id)
    {
        return GalleryAlbum::with(['images' => function ($query) {
            $query->orderBy('sort_order');
        }])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $album = GalleryAlbum::create($validated);
        return response()->json($album, 201);
    }

    public function update(Request $request, $id)
    {
        $album = GalleryAlbum::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $album->update($validated);
        return response()->json($album);
    }

    public function destroy($id)
    {
        GalleryAlbum::findOrFail($id)->delete();
        return response()->json(['message' => 'Album deleted']);
    }
}
