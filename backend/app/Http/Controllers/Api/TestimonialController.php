<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        // Public sees only approved
        if ($request->has('public')) {
            return Testimonial::where('is_approved', true)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return Testimonial::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_name' => 'required|string',
            'content' => 'required|string',
            'student_name' => 'nullable|string',
            'rating' => 'integer|min:1|max:5',
        ]);
        
        // Default to not approved
        $validated['is_approved'] = false;

        $testimonial = Testimonial::create($validated);
        return response()->json($testimonial, 201);
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        $validated = $request->validate([
            'parent_name' => 'sometimes|string',
            'content' => 'sometimes|string',
            'student_name' => 'nullable|string',
            'rating' => 'integer|min:1|max:5',
            'is_approved' => 'boolean'
        ]);

        $testimonial->update($validated);
        return response()->json($testimonial);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return response()->json(['message' => 'Testimonial deleted']);
    }
}
