<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Section;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|string',
            'sort_order' => 'integer',
            'content' => 'required|array'
        ]);

        $section = Section::create($validated);
        return response()->json($section, 201);
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        
        $validated = $request->validate([
            'type' => 'sometimes|string',
            'sort_order' => 'sometimes|integer',
            'content' => 'sometimes|array'
        ]);

        $section->update($validated);
        return response()->json($section);
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        return response()->json(['message' => 'Section deleted']);
    }
}
