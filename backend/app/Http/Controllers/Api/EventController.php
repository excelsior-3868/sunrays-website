<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Simple filter for public frontend
        if ($request->has('published')) {
            return Event::where('is_published', true)
                ->orderBy('start_time', 'asc')
                ->get();
        }
        return Event::orderBy('start_time', 'desc')->get();
    }

    public function show($id)
    {
        return Event::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:events,slug',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'slug' => 'sometimes|string|unique:events,slug,' . $id,
            'start_time' => 'sometimes|date',
            'end_time' => 'nullable|date',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $event->update($validated);
        return response()->json($event);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
