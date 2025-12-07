<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|image|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store in 'public/uploads' which is linked to 'public/storage/uploads'
            $path = $file->storeAs('uploads', $filename, 'public');

            // Generate full URL
            $url = asset('storage/' . $path);

            return response()->json([
                'url' => $url,
                'path' => $path
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
