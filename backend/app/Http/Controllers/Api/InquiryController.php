<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        return Inquiry::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'required|string',
            'subject' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $inquiry = Inquiry::create($validated);
        // TODO: Trigger email notification here
        
        return response()->json($inquiry, 201);
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|string', // e.g., 'contacted', 'closed'
        ]);

        $inquiry->update($validated);
        return response()->json($inquiry);
    }

    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return response()->json(['message' => 'Inquiry deleted']);
    }
}
