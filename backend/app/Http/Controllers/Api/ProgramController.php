<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        return Program::all();
    }

    public function show($id)
    {
        return Program::where('id', $id)->orWhere('slug', $id)->firstOrFail();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:programs,slug',
            'age_group' => 'nullable|string',
            'timing' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'fee' => 'nullable|numeric'
        ]);

        $program = Program::create($validated);
        return response()->json($program, 201);
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'slug' => 'sometimes|string|unique:programs,slug,' . $id,
            'age_group' => 'nullable|string',
            'timing' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'fee' => 'nullable|numeric'
        ]);

        $program->update($validated);
        return response()->json($program);
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();
        return response()->json(['message' => 'Program deleted']);
    }
}
