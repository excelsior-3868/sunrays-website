<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    // Public: Fetch page by slug with sections
    public function getBySlug($slug = 'home')
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->with(['sections' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->firstOrFail();

        return response()->json($page);
    }

    // Admin: List all pages
    public function index()
    {
        return Page::all();
    }

    // Admin: Create page
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug',
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $page = Page::create($validated);
        return response()->json($page, 201);
    }

    // Admin: Show page details
    public function show($id)
    {
        return Page::with('sections')->findOrFail($id);
    }

    // Admin: Update page
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:pages,slug,' . $id,
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $page->update($validated);
        return response()->json($page);
    }

    // Admin: Delete page
    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return response()->json(['message' => 'Page deleted']);
    }
}
