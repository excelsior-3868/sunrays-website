<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('published')) {
            return BlogPost::whereNotNull('published_at')
                ->orderBy('published_at', 'desc')
                ->paginate(10);
        }
        return BlogPost::orderBy('created_at', 'desc')->get();
    }

    public function show($identifier)
    {
        // Allow fetch by ID or Slug
        return BlogPost::where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->firstOrFail();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:blog_posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'cover_image' => 'nullable|string',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date'
        ]);

        $post = BlogPost::create($validated);
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'slug' => 'sometimes|string|unique:blog_posts,slug,' . $id,
            'excerpt' => 'nullable|string',
            'content' => 'sometimes|string',
            'cover_image' => 'nullable|string',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date'
        ]);

        $post->update($validated);
        return response()->json($post);
    }

    public function destroy($id)
    {
        BlogPost::findOrFail($id)->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
