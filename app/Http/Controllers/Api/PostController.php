<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $imagePath = public_path('storage/' . $imagePath);
        } else {
            return response()->json(['error' => 'Image upload failed'], 400);
        }

        // Create the post
        $post = $request->user()->posts()->create([
            'caption' => $validatedData['caption'] ?? null,
            'post_image' => $imagePath,
        ]);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
}
